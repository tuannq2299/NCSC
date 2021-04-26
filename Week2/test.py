import json
with open("info.json","r") as f:
	data=f.read()
	data=json.loads(data)
	print(data)