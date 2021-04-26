import click
import json
from prettytable import PrettyTable
import requests
import urllib
import os
import sys
import html
from pyfiglet import Figlet


@click.command()
@click.option("--exploit_id", help="=[EDB-ID] Chi tiết exploit.")
@click.option("--page_num" , help="=[num] Danh sách các exploits .")
@click.option("--favorite" ,flag_value='favorite', help="Hiển thị title các exploit người dùng đánh dấu .")

def welcome(page_num,exploit_id,favorite):
	if page_num:
		sendRequest(page_num)
		printTable(page_num)
	# elif "None" not in exploit_id:
	elif exploit_id:
		loadDetail(exploit_id)
	elif favorite:
		if os.path.exists("info.json"):
			with open("info.json","r") as f:
				data = f.read()
				data = json.loads(data)
				with open("info.json","r") as f:
					data = f.read()
					data = json.loads(data)
					data = data[0]["Plugin danh dau"]
					print(f"Danh sach plugin da danh dau: {data}")
	if not page_num and not exploit_id:
		f = Figlet(font='slant')
		print(f.renderText('___ExploitDB___'))
		with open("info.json","r") as f:
			temp = f.read()
			temp = json.loads(temp)
			temp=temp[0]
		print(f"Plugin da danh dau: {temp['Plugin danh dau']} ")
		print(f"Cac exploit_id xem gan nhat: {temp['Exploit_id xem gan nhat']}")
		print(f"Cac trang xem gan nhat: {temp['Trang xem gan nhat']}")
	while True:
		data = input("> ")
		data = data.split(" ")
		if data[0] == "exploit_id":
			loadDetail(data[1])
		elif data[0] == "page_num":
			if os.path.exists("data1.json"):
				with open("data1.json","r+") as f:
					f.seek(0)
					f.truncate()
			sendRequest(data[1])
			printTable(data[1])
		elif data[0] == "favorite":
			if data[1] != "list":
				favorite = data[1]
				rq = f"favorite@{favorite}"
				updateFile(rq)
				print("Danh dau plugin thanh cong!")
			else:
				with open("info.json","r") as f:
					data = f.read()
					data = json.loads(data)
					data = data[0]["Plugin danh dau"]
					print(f"Danh sach plugin da danh dau: {data}")

		elif data[0] == "exit":
			raise SystemExit()
		elif data[0] == "help":
			temp = "exploit_id [EDB-ID]: Trả về giao diện chi tiết exploit\npage_num [num]: Trả về giao diện danh sách các exploits trong page đó\nfavorite: Trả về giao diện hiển thị title các exploit người dùng đánh dấu\nhelp: Trả về usage\nNone: Giao dien Welcome"
			print(temp)
		else:
			print("Wrong cmd! Use help!")
def loadDetail(exploit_id):
	try:
		url = f"https://www.exploit-db.com/exploits/{exploit_id}"
		data=urllib.request.urlopen(url).read()
		with open("url.txt","wb") as f:
			f.write(data)
		with open("url.txt",encoding='utf8') as f:
			text = f.read()
			temp = text.split('<code class=')[1].split('style="white-space: pre-wrap;">')[1].split("</code>")[0]
			temp = html.unescape(temp)
			print(temp)
		rq = f"exploit_id@{exploit_id}"
		updateFile(rq)
	except Exception as e:
		print(str(e))
	

def sendRequest(page_num):
	headers = {
		"accept": "application/json, text/javascript, */*; q=0.01",
		"accept-encoding": "gzip, deflate, br",
		"accept-language": "vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
		"referer": "https://www.exploit-db.com/search",
		"sec-fetch-dest": "empty",
		"sec-fetch-mode": "cors",
		"sec-fetch-site": "same-origin",
		"user-agent": "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36",
		"x-requested-with": "XMLHttpRequest"
	}
	temp = (int(page_num) - 1)*15
	url =f"https://www.exploit-db.com/search?columns%5B0%5D%5Bdata%5D=date_published&columns%5B0%5D%5Bname%5D=date_published&columns%5B0%5D%5Bsearchable%5D=true&columns%5B0%5D%5Borderable%5D=true&columns%5B0%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B0%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B1%5D%5Bdata%5D=download&columns%5B1%5D%5Bname%5D=download&columns%5B1%5D%5Bsearchable%5D=false&columns%5B1%5D%5Borderable%5D=false&columns%5B1%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B1%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B2%5D%5Bdata%5D=application_md5&columns%5B2%5D%5Bname%5D=application_md5&columns%5B2%5D%5Bsearchable%5D=true&columns%5B2%5D%5Borderable%5D=false&columns%5B2%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B2%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B3%5D%5Bdata%5D=verified&columns%5B3%5D%5Bname%5D=verified&columns%5B3%5D%5Bsearchable%5D=true&columns%5B3%5D%5Borderable%5D=false&columns%5B3%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B3%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B4%5D%5Bdata%5D=description&columns%5B4%5D%5Bname%5D=description&columns%5B4%5D%5Bsearchable%5D=true&columns%5B4%5D%5Borderable%5D=false&columns%5B4%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B4%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B5%5D%5Bdata%5D=type_id&columns%5B5%5D%5Bname%5D=type_id&columns%5B5%5D%5Bsearchable%5D=true&columns%5B5%5D%5Borderable%5D=false&columns%5B5%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B5%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B6%5D%5Bdata%5D=platform_id&columns%5B6%5D%5Bname%5D=platform_id&columns%5B6%5D%5Bsearchable%5D=true&columns%5B6%5D%5Borderable%5D=false&columns%5B6%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B6%5D%5Bsearch%5D%5Bregex%5D=false&columns%5B7%5D%5Bdata%5D=author_id&columns%5B7%5D%5Bname%5D=author_id&columns%5B7%5D%5Bsearchable%5D=false&columns%5B7%5D%5Borderable%5D=false&columns%5B7%5D%5Bsearch%5D%5Bvalue%5D=&columns%5B7%5D%5Bsearch%5D%5Bregex%5D=false&order%5B0%5D%5Bcolumn%5D=0&order%5B0%5D%5Bdir%5D=desc&length=15&search%5Bvalue%5D=&search%5Bregex%5D=false&start={temp}"
	response = requests.get(url,headers = headers)
	if response.status_code == 200:
		data_json=response.json()
		total = data_json['recordsTotal']
		with open("data1.json","w") as f:
			json.dump(data_json['data'], f)
		rq = f"page_num@{page_num}"
		updateFile(rq)
	else:
		print("Not found")

def printTable(page_num):
		with open("data1.json","r") as f:
			data = f.read()
			data_json = json.loads(data)
			# print(data_json)
			table = PrettyTable(['EDB-ID', 'Product', 'CVE', 'Platform'])
			for i in range(0,len(data_json)):
				ls = data_json[i]['code']
				temp=""
				if len(ls)>0:
					for j in range(0,len(ls)):
						temp=temp + "CVE:"+ ls[j]['code']+" "
				des = data_json[i]['description'][1]
				des = html.unescape(des)
				table.add_row([data_json[i]['id'],des,temp,data_json[i]['platform']['platform']])
			print(table)

def updateFile(data):
	data = data.split("@")
	temp=""
	if os.path.exists("info.json"):
		with open("info.json","r") as f:
			temp = f.read()
			temp = json.loads(temp)
			temp=temp[0]
	with open("info.json","w") as f:
		if data[0]=="exploit_id":
			if len(temp['Exploit_id xem gan nhat'])==3:
				temp['Exploit_id xem gan nhat'].pop(0)
			temp['Exploit_id xem gan nhat'].append(data[1])
		elif data[0]=="page_num":
			if len(temp['Trang xem gan nhat'])==3:
				temp['Trang xem gan nhat'].pop(0)
			temp['Trang xem gan nhat'].append(data[1])
		elif data[0]=="favorite":
			temp['Plugin danh dau'].append(data[1])
		ls =[temp]
		json.dump(ls,f)


welcome()