
import pandas as pd
import time
import re
import csv
import json
from selenium.webdriver import Chrome, ChromeOptions
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By

class OddsTable:
    def __init__(self):
        self.odds_table = pd.DataFrame()
        options= ChromeOptions()
        options.add_argument('--no-sandbox')
        options.add_argument('--headless')
        options.add_argument('--disable-dev-shm-usage')
        self.driver = Chrome(executable_path=r'/usr/local/bin/chromedriver',options=options)

    def scrape_odds_table(self, year, mm, dd, place_w, race):
        odds_list = []
        place_dict = {"sapporo":1,"hakodate":2,"fukushima":3,"niigata":4,"tokyo":5,"nakayama":6,"chukyo":7,"kyoto":8,"hanshin":9,"kokura":10}
        place = place_dict[place_w]

        url = self.get_target_date_url(year, mm, dd, place, race)
        self.driver.get(url)

        # オッズテーブルを作成する
        elements = self.driver.find_elements(By.CLASS_NAME,'RaceOdds_HorseList_Table')
        element = elements[0] # 1回目は単勝、2回目は複勝、3回目は単勝・複勝のテーブル
        horsenum_waku = 1
        horsenum_num = 0
        horsename = ""
        odds = 0
        tds = element.find_elements(By.TAG_NAME,'td')
        for td in tds:
            #print(td.get_attribute('class'))
            if "Waku" in td.get_attribute('class'):
                horsenum = re.findall(r'Waku(\d+)',td.get_attribute('class'))
                horsenum_waku = int(horsenum[0])
                horsenum_num = int(td.text)
            if "Horse_Name" in td.get_attribute('class'):
                horsename = td.text
            if "Odds" in td.get_attribute('class'):
                if td.text in ["取消","除外","中止"]:
                    odds = -1
                else:
                    odds = float(td.text)
                odds_list.append({"waku":horsenum_waku,"umaban":horsenum_num,"horsename":horsename,"odds":odds})
        self.driver.close()
        return odds_list

    def numStr(self, num):
        if num >= 10:
            return str(num)
        else:
            return '0' + str(num)

    # 入力した日付のページのurlを返す
    def get_target_date_url(self, year, mm, dd, place, race):
        Base = "https://race.sp.netkeiba.com/?pid=odds_view&type=b1&race_id="
        kaisai_json_fn = '/var/www/laravel/download/kaisai.json'
        # 開催回と開催日数の取得は時間がかかるので、jsonに既に保存された日付にものであればそれを使う
        kaisai_json_open = open(kaisai_json_fn,'r')
        kaisai_json = json.load(kaisai_json_open)
        if kaisai_json["year"] == year and kaisai_json["month"] == mm and kaisai_json["date"] == dd and kaisai_json["place"] ==place and kaisai_json["kaisai_times"] != -1 and kaisai_json["kaisai_day"] != -1:
            kaisai_times = kaisai_json["kaisai_times"]
            kaisai_day = kaisai_json["kaisai_day"]
            url = "%s%s%s%s%s%s&housiki=c0&rf=shutuba_submenu" % (Base, str(year), self.numStr(place), self.numStr(kaisai_times), self.numStr(kaisai_day), self.numStr(race))
            return url
        else:
            for i in range(1,9): # 開催回
                multi_continue = 0
                for j in range(1,13): # 開催日数
                    if multi_continue > 0:
                        multi_continue = multi_continue - 1
                        continue
                    url = "%s%s%s%s%s%s&housiki=c0&rf=shutuba_submenu" % (Base, str(year), self.numStr(place), self.numStr(i), self.numStr(j), self.numStr(race))
                    self.driver.get(url)

                    racedetail_elements = self.driver.find_element(By.CLASS_NAME,'Race_Detail_Info_Btn')
                    CommonDate = racedetail_elements.find_element(By.CLASS_NAME,'Change_Btn').text if "Day" in racedetail_elements.find_element(By.CLASS_NAME,'Change_Btn').get_attribute('class') else ""
                    splitted = re.split(r"/|\(", CommonDate)
                    CommonMM = int(splitted[0])
                    CommonDD = int(splitted[1])
                    print(mm, dd, CommonDate, i, "開催", j, "日目")
                    if CommonMM < mm-1:
                        break
                    # 何度も回すと相当な時間がかかるため検索回数を減らす工夫
                    if CommonMM != mm or CommonDD != dd:
                        date_diff = dd-CommonDD
                        if CommonMM != mm:
                            date_diff = date_diff + 31
                        if date_diff > 7:
                            multi_continue = (int(date_diff/7)-1)*2
                            #print(str(multi_continue)+"days skip")
                    else:
                        print("該当レースのURL発見：", url)
                        kaisai_list = {"year":year,"month":mm,"date":dd,"place":place,"kaisai_times":i,"kaisai_day":j}
                        with open(kaisai_json_fn,'w') as f:
                            json.dump(kaisai_list, f, ensure_ascii=False)
                        return url
                    time.sleep(1)
        return none

# メイン処理、入力レースのオッズデータをjsonファイルに書き出す
in_json_open = open('/var/www/laravel/download/scrape_input.json','r')
in_json = json.load(in_json_open)

ot = OddsTable()
odds_list = ot.scrape_odds_table(in_json["year"],in_json["month"],in_json["date"],in_json["place"],in_json["race"])
print(odds_list)

with open('/var/www/laravel/download/scrape_output.json','w') as f:
    json.dump({"odds_info":odds_list}, f, ensure_ascii=False)
