import json
import urllib.request
import requests
from bs4 import BeautifulSoup
import time

eiin_dictionary = []

with urllib.request.urlopen("http://resultarchive.rafathossain.xyz/public/eiin") as url:
    data = json.loads(url.read().decode())
    for item in data['eiin']:
        if item['status'] == "Unavailable":
            if item['eiin'] not in eiin_dictionary:
                eiin_dictionary.append(item['eiin'] + "_" + item["board"])

while True:
    try:
        eiin_dictionary = []
        with urllib.request.urlopen("http://resultarchive.rafathossain.xyz/public/eiin") as url:
            data = json.loads(url.read().decode())
            for item in data['eiin']:
                if item['status'] == "Unavailable":
                    if item['eiin'] not in eiin_dictionary:
                        eiin_dictionary.append(item['eiin'] + "_" + item["board"])

        print(eiin_dictionary)

        for e_data in eiin_dictionary:
            eiin = e_data.split("_")[0]
            board = e_data.split("_")[1]

            url = "http://mail.educationboard.gov.bd/web/result.php"

            payload = {'board': board,
                       'eiin': eiin,
                       'rtype': 'SSC_FINAL'}

            files = [

            ]

            headers = {}

            response = requests.request("POST", url, headers=headers, data=payload, files=files)

            soup = BeautifulSoup(response.content, 'html.parser')

            requests.get("http://resultarchive.rafathossain.xyz/public/eiin/flag?eiin=" + eiin)
            time.sleep(6)

            try:
                year = soup.find_all('pre')[0].get_text().strip().split('\n')[1].split(',')[1].strip()

                if year == "2020":
                    institute = soup.find_all('pre')[1].get_text().strip().split('\n')[0].split(':')[1].strip()
                    institute = institute.split("(")[0].strip()
                    institute = institute.replace("&", "and")
                    centre = soup.find_all('pre')[1].get_text().strip().split('\n')[1].split(',')[0].strip()
                    centre = centre.split(":")[1].strip()
                    centre = centre.replace("&", "and")
                    total = 0
                    result = soup.find_all('p')[0].get_text().strip().split('\n')
                    for item in result:
                        if len(item.split("BUSINESS STUDIES")) > 1:
                            item = item.split("BUSINESS STUDIES")[1]
                            parts = item.split("[")
                            roll = parts[0].strip()
                            gpa = parts[1].split("]")[0].strip()
                            requests.get(
                                "http://resultarchive.rafathossain.xyz/public/set_result?eiin=" + eiin + "&roll=" + roll + "&gpa=" + gpa + "&institute=" + institute + "&centre=" + centre)
                            # print(roll + " " + gpa)
                            total += 1
                        elif len(item.split("SCIENCE")) > 1:
                            item = item.split("SCIENCE")[1]
                            parts = item.split("[")
                            roll = parts[0].strip()
                            gpa = parts[1].split("]")[0].strip()
                            requests.get(
                                "http://resultarchive.rafathossain.xyz/public/set_result?eiin=" + eiin + "&roll=" + roll + "&gpa=" + gpa + "&institute=" + institute + "&centre=" + centre)
                            # print(roll + " " + gpa)
                            total += 1
                        elif len(item.split("[")) > 1:
                            parts = item.split("[")
                            roll = parts[0].strip()
                            gpa = parts[1].split("]")[0].strip()
                            requests.get(
                                "http://resultarchive.rafathossain.xyz/public/set_result?eiin=" + eiin + "&roll=" + roll + "&gpa=" + gpa + "&institute=" + institute + "&centre=" + centre)
                            # print(roll + " " + gpa)
                            total += 1
                    print(institute + ": " + total)
            except Exception:
                print("Result not published")
                break
        time.sleep(6)
    except Exception:
        print("Error Occurred")
