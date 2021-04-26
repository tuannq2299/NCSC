import socket
import select
PORT = 9669
HOST = "127.0.0.1"
SIZE = 4096

cmd_list = {}
msg_list = {}
user_list=['tuannq','hlinh','quy','hiep']
mess = {}
name_list={}
read_list=[]
def main():
	sock=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
	print("### Starting ###")
	read_list.append(sock)
	sock.bind((HOST,PORT))
	sock.listen()
	print("### Listening ###")
	while True:
		read_sockets,write_sockets,err_sockets=select.select(read_list, [], [],1)
		# print(read_sockets)
		for s in read_sockets:
			if s is sock:
				(clientSock,clientAddr) = s.accept()
				read_list.append(clientSock)
				print(f"### New connection from {clientAddr} ###\n")
				
			else:
				# try:
				data = s.recv(SIZE).decode('ascii')
				if data:
					data = data.split("@")
					cmd_list[s] = data[0]
					if cmd_list[s] == 'login':
						if data[1] not in user_list: 
							msg_list[s] = "Login fail!".encode('ascii')
						else:
							msg_list[s] = f"Hello {data[1]}".encode('ascii')
							name_list[data[1]] = s
						write_sockets.append(s)
					elif cmd_list[s] == 'list':
						temp="List user:\n"
						temp += "\n".join(user for user in user_list)
						msg_list[s] = temp.encode('ascii')
						if s not in write_sockets:
							write_sockets.append(s)
					elif cmd_list[s] == 'rqchat':
						if data[1] not in user_list:
							msg_list[s]="no user".encode('ascii')
						else:
							print(f"[Load waiting mess...]")
							msg_list[s] = "connected".encode('ascii')
							mess[data[2]]={data[1]:[]}
							# if data[1] in mess:
							# 	# name_list.get(data[1]).send(mess[data[1]][data[2]].encode('ascii'))
							# 	msg_list[s] = mess[data[1]][data[2]]
							# 	cmd_list[s] = 'recvchat'
							# 	print(msg_list[s])
							# if len(list_temp)>0:
							# 	print("in")
							# 	temp = mess.get(data[1]).get(data[2])
							# 	msg_list[s] = temp
							# 	cmd_list[s] = 'recvchat'
							# 	# mess.update({data[2]:{data[1]:mess_list}})
							# 	print(temp)
						if s not in write_sockets:
							write_sockets.append(s)
					elif cmd_list[s] == 'sendchat':
						sender = data[1]
						receiver = data[2]
						if receiver in name_list:
							msg = f"sendchat@{data[3]}"
							name_list.get(receiver).send(msg.encode('ascii'))
						else:
							msg = data[3]
							if type(mess[receiver][sender])==list:
								mess.get(receiver).get(sender).append(msg)
							else:
								mess_list=[]
								mess[receiver]={sender:mess_list}

				else:
					if s in read_list:
						read_list.remove(s)
				# except:
				# 	print("### Disconnected {clientAddr} ###")
				# 	read_list.remove(s)
		for s in write_sockets:
			if s!=sock:
				if cmd_list[s]=='login':
					s.send(msg_list[s])
					write_sockets.remove(s)
				elif cmd_list[s]=='list':
					s.send(msg_list[s])
					write_sockets.remove(s)
				elif cmd_list[s]=='rqchat':
					s.send(msg_list[s])
					write_sockets.remove(s)
				elif cmd_list[s]=='recvchat':
					for i in msg_list[s]:
						wait_ms = f"recvchat@{i}".encode('ascii')
						s.send(wait_ms)
					write_sockets.remove(s)
	sock.close()

if __name__=="__main__":
	main()

