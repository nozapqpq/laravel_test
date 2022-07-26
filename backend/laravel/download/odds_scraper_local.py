
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
        place_dict = {"monbetsu":30,"morioka":35,"mizusawa":36,"urawa":42,"funabashi":43,"oi":44,"kawasaki":45,"kanazawa":46,"kasamatsu":47,"nagoya":48,"sonoda":50,"himeji":51,"kochi":54,"saga":55,"obihiro":65}
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
        umaban_count = 1
        for td in tds:
            #print(td.get_attribute('class'))
            if "Waku" in td.get_attribute('class'):
                horsenum = re.findall(r'Waku(\d+)',td.get_attribute('class'))
                horsenum_waku = int(horsenum[0])
                horsenum_num = umaban_count
                umaban_count += 1
            if "Horse_Name" in td.get_attribute('class'):
                horsename = td.text
            if "Odds" in td.get_attribute('class'):
                if len(td.text) == 0 or td.text in ["取消","除外","中止"]:
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
        Base = "https://nar.netkeiba.com/odds/index.html?type=b1&race_id="
        url = "%s%s%s%s%s%s&rf=shutuba_submenu" % (Base, str(year), self.numStr(place), self.numStr(mm), self.numStr(dd), self.numStr(race))
        return url

# メイン処理、入力レースのオッズデータをjsonファイルに書き出す
in_json_open = open('/var/www/laravel/download/scrape_input.json','r')
in_json = json.load(in_json_open)

ot = OddsTable()
odds_list = ot.scrape_odds_table(in_json["year"],in_json["month"],in_json["date"],in_json["place"],in_json["race"])
print(odds_list)

with open('/var/www/laravel/download/scrape_output.json','w') as f:
    json.dump({"odds_info":odds_list}, f, ensure_ascii=False)
