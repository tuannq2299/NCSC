import socket
import os
import sys
HOST = sys.argv[1]
PORT = int(sys.argv[2])
ADDR = (HOST,PORT)
SIZE = 4096

def main():
	s = socket.socket(socket.AF_INET,socket.SOCK_STREAM)
	s.connect(ADDR)
	checkRq=1
	while True:
		if checkRq==1:
			data = s.recv(SIZE).decode('ascii')
			cmd, msg = data.split('@')
			if cmd == "DISCONNECTED":
				print(f"[SERVER]: {msg}")
				break
			elif cmd == "tuannq":
				print(f"{msg}")
		data = input("> ")
		data = data.split(" ")
		cmd = data[0]
		if data:
			checkRq = 1
		if cmd == "help":
			s.send(cmd.encode('ascii'))
		elif cmd == "list":
			s.send(cmd.encode('ascii'))
		elif cmd == "upload":
			filepath = data[1]
			# print(os.path.exists(filepath))
			if os.path.exists(filepath):
				with open(f"{filepath}","rb") as f:
					sendData = f"{cmd}@{filepath}"
					s.send(sendData.encode('ascii'))
					while data:
						data = f.read(SIZE)
						# print(len(data))
						s.send(data)
						if len(data)==0:
							break
			else:
				print("The file name was Wrong!")
				checkRq=0
		elif cmd == "download":
			path = data[1]
			fileName = path
			with open(fileName,'wb') as f:
				sendData = f"{cmd}@{fileName}"
				s.send(sendData.encode('ascii'))
				data = s.recv(SIZE)
				if "Wrong" in data.decode('ascii'):
					print(data.decode('ascii'))
					checkRq = 0
				else:	
					while True:
						data = s.recv(SIZE)
						f.write(data)
						# print(len(data))
						if len(data)<SIZE:
							print("Download successfully!")
							checkRq=0
							break
		elif cmd == "logout":
			s.send(cmd.encode('ascii'))
			break
		else:
			print("Wrong command!")
			checkRq=0
	print("Disconected.")
	s.close()	
	# s.send("test".encode('ascii'))
	# with s,open('received_file.zip', 'wb') as f:
	# 	while True:
	# 		data = s.recv(SIZE)
	# 		print(len(data))
	# 		if len(data)<SIZE:	
	# 			print("end")
	# 			break
	# 		f.write(data)

main()


