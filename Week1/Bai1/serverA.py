import socket
import os
import select
PORT = 9669
HOST = '127.0.0.1'
DATA_PATH = 'serverData'
SIZE = 4096
read_list = []
write_list = []
cmd_list = {}
msg_list = {}
def main():
	print("--STARTING--")
	sock = socket.socket(socket.AF_INET,socket.SOCK_STREAM)
	read_list.append(sock)
	sock.bind((HOST,PORT))
	sock.listen(2)
	print("--LISTENING--")
	while True:
		read_sockets, write_sockets, error_sockets = select.select(read_list ,[], [],1)
		# print(read_sockets)
		for s in read_sockets:
			if s is sock:
				(clientSock,clientAddr) = s.accept()
				read_list.append(clientSock)
				print(f"[NEW CONNECTION from ]{clientAddr}.")
				clientSock.send("tuannq@Welcome to server".encode('ascii'))
				# handle(clientSock, clientAddr)
			else:
				try:
					data = s.recv(SIZE).decode('ascii')
					# print(data)
					if data:
						data = data.split("@")
						cmd_list[s] = data[0]
						if cmd_list[s] == "list":
							files = os.listdir(DATA_PATH)
							data = "tuannq@"
							if len(files) == 0:
								data += "The folder is empty"
							else:
								data += "\n".join(file for file in files)
							if not write_sockets.__contains__(s):
								write_sockets.append(s)
								
							msg_list[s]=data.encode('ascii')
						elif cmd_list[s] == "upload":
							name = data[1]
							filepath = os.path.join(DATA_PATH, name)
							with open(filepath,'wb') as f:
								while True:
									data = s.recv(SIZE)
									# print(len(data))
									f.write(data)
									if len(data)<SIZE:	
										break
							data = "tuannq@Upload successfully."
							if not write_sockets.__contains__(s):
								write_sockets.append(s)
							msg_list[s] = data.encode('ascii')
						elif cmd_list[s] == "logout":
							print()
							break
						elif cmd_list[s] == "download":
							if not write_list.__contains__(s):
								if not write_sockets.__contains__(s):
									write_sockets.append(s)
							msg_list[s] = data
						elif cmd_list[s] == "help":
							data = "tuannq@"
							data += "list: List all the files.\n"
							data += "upload <path_file>: Upload a file to server.\n"
							data += "download <file_name>: Download a file from server.\n"
							data += "logout: Disconnect from the server.\n"
							data += "help: List all the commands."
							if not write_sockets.__contains__(s):
								write_sockets.append(s)
							msg_list[s] = data.encode('ascii')
					# print(f"[DISCONNECTED] {clientAddr}")
					# s.close()
					else:
						if s in read_list:
							read_list.remove(s)
				except:
					print(f"[DISCONNECTED] {clientAddr}")
					sock.close()
		for s in write_sockets:
			# print(s)
			if s != sock:
				if cmd_list[s] == "list":
					s.send(msg_list[s])
					write_sockets.remove(s)
				elif cmd_list[s] == "help":
					s.send(msg_list[s])
					write_sockets.remove(s)
				elif cmd_list[s] == "download":
					data=msg_list[s]
					name = data[1]
					filepath = os.path.join(DATA_PATH, name)
					if os.path.exists(filepath):
						s.send("ok!".encode('ascii'))
						with open(filepath,'rb') as f:
							data = f.read(SIZE)
							s.send(data)
							while data:
								data = f.read(SIZE)
								s.send(data)
								# print(len(data))
								if len(data)==0:
									break
							# s.send("tuannq@Download successfully".encode('ascii'))
							write_sockets.remove(s)
					else:
						s.send("The file name was Wrong!".encode('ascii'))
						write_sockets.remove(s)
				elif cmd_list[s] == "upload":
					s.send(msg_list[s])
					write_sockets.remove(s)
					# write_list.remove(s)
	sock.close()


if __name__=="__main__":
	main()
