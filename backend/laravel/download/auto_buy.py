from selenium.webdriver import Chrome, ChromeOptions
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.alert import Alert
import time
import json
import datetime

def login(userid, password, pars):
    driver.get(url)
    time.sleep(sleep_sec)
    driver.find_element(By.ID,"userid").send_keys(userid)
    driver.find_element(By.ID,"password").send_keys(password)
    driver.find_element(By.ID,"pars").send_keys(pars)
    time.sleep(sleep_sec)
    driver.find_element(By.CLASS_NAME,'btnGreen').click()
    time.sleep(sleep_sec)
    driver.find_element(By.CLASS_NAME, 'ico_regular').click()
    time.sleep(sleep_sec)

def buy(place, race_no, buy_list):
    driver.find_element(By.PARTIAL_LINK_TEXT,place).click()
    time.sleep(sleep_sec)
    print(race_no)
    driver.find_element(By.PARTIAL_LINK_TEXT,str(race_no)+'R').click()
    time.sleep(sleep_sec)
    driver.find_element(By.PARTIAL_LINK_TEXT,'単勝').click()
    time.sleep(sleep_sec)
    driver.find_element(By.CLASS_NAME,'selectHorse').find_elements(By.CLASS_NAME,'ui-link')
    time.sleep(sleep_sec)
    all_buy_amount = 0
    for i in range(len(buy_list["umaban"])):
        all_buy_amount += buy_list["buy"][i]*100
        driver.find_element(By.CLASS_NAME,'selectHorse').find_elements(By.CLASS_NAME,'ui-link')[buy_list["umaban"][i]-1].click()
        time.sleep(sleep_sec)
        driver.find_element(By.CLASS_NAME, 'ui-input-text').send_keys(str(buy_list["buy"][i])) # bl["buy"]*100円買う
        time.sleep(sleep_sec)
        driver.find_element(By.LINK_TEXT,'セット').click()
        time.sleep(sleep_sec)
        driver.find_element(By.PARTIAL_LINK_TEXT,'番から').click()
        time.sleep(sleep_sec)
    driver.find_element(By.LINK_TEXT,'取消').click()
    time.sleep(sleep_sec)
    driver.find_element(By.LINK_TEXT,'入力終了').click()
    time.sleep(sleep_sec)
    driver.find_element(By.ID,'sum').send_keys(str(all_buy_amount))
    time.sleep(sleep_sec)
    driver.find_element(By.LINK_TEXT,'投票').click()
    time.sleep(sleep_sec)
    Alert(driver).accept()
    time.sleep(sleep_sec)
    driver.find_element(By.LINK_TEXT,'続けて通常投票').click()#通常投票画面に返る
    time.sleep(sleep_sec)
    with open('/var/www/laravel/download/auto_buy.log','a') as f:
        buy_time = str(datetime.datetime.now()+datetime.timedelta(hours=9))
        f.write(str([buy_time,all_buy_amount,buy_list])+"\n")


options= ChromeOptions()
options.add_argument('--no-sandbox')
options.add_argument('--headless')
options.add_argument('--disable-dev-shm-usage')
driver = Chrome(executable_path=r'/usr/local/bin/chromedriver',options=options)
url = "https://www.ipat.jra.go.jp/sp/"
place_kanji_dict = {"sapporo":"札幌","hakodate":"函館","fukushima":"福島","niigata":"新潟","nakayama":"中山","tokyo":"東京","chukyo":"中京","kyoto":"京都","hanshin":"阪神","kokura":"小倉","monbetsu":"門別","morioka":"盛岡","mizusawa":"水沢","urawa":"浦和","funabashi":"船橋","oi":"大井","kawasaki":"川崎","kanazawa":"金沢","kasamatsu":"笠松","nagoya":"名古屋","sonoda":"園田","himeji":"姫路","kochi":"高知","saga":"佐賀","obihiro":"帯広"}

race_info_json_open = open('/var/www/laravel/download/scrape_input.json','r')
race_info_json = json.load(race_info_json_open)

buy_info_json_open = open('/var/www/laravel/download/auto_buy.json','r')
buy_info_json = json.load(buy_info_json_open)

if len(buy_info_json) > 0:
    sleep_sec = 400/1000
    print(place_kanji_dict[race_info_json['place']],race_info_json['race'])
    print(buy_info_json)
    login("","","")
    buy(place_kanji_dict[race_info_json['place']],race_info_json['race'],buy_info_json)