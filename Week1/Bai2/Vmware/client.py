import sys
import socket
import select

HOST = sys.argv[1]
PORT = int(sys.argv[2])
SIZE = 4096
ADDR = (HOST,PORT)
sock = socket.socket(socket.AF_INET,socket.SOCK_STREAM)

msg_list = []
read_list = []
def main():
	sock.connect(ADDR)
	name="none"
	partner="none"
	isChat=0
	read_list.append(sock)
	read_list.append(sys.stdin)
	while True:
		read_sockets,write_sockets,err_sockets=select.select(read_list, [], [],1)
		for s in read_sockets:
			try:
				if s==sock:
					data=s.recv(SIZE).decode('ascii')
					if data:
						if "Hello" in data:
							print(data)
							data=data.split(" ")
							name=data[1]
							if s not in write_sockets:
								write_sockets.append(s)
							break
						elif "fail" in data:
							print(data)
							if s not in write_sockets:
								write_sockets.append(s)
							break
						elif "no user" in data:
							print(data)
							if s not in write_sockets:
								write_sockets.append(s)
							break
						elif "connected" in data:
							print(f"You are chatting with {partner}")
							if s not in write_sockets:
								write_sockets.append(s)
							break
						elif "List" in data:
							print(data)
							if s not in write_sockets:
								write_sockets.append(s)
							break
						elif "recvchat" in data:
							cmd,data = data.split("@")
							if s not in write_sockets:
								write_sockets.append(s)
							print(f"{partner}>>> {data}")
					else:
						read_list.remove(s)
				if s==sys.stdin:
					if isChat==0:
						if name=="none":
							data = sys.stdin.readline()
							data=data.rstrip()
							print(f"> {data}")
							data = data.split(" ")
						elif name!="none" and partner=="none":
							data = sys.stdin.readline()
							data = data.rstrip()
							print(f"{name}> {data}")
							data = data.split(" ")
						else:
							isChat=1
						if data:
							cmd = data[0]
							if cmd == 'login':
								sock.send(f"{data[0]}@{data[1]}".encode('ascii'))
							elif cmd == 'list':
								sock.send(f"{cmd}".encode('ascii'))
								write_sockets.remove(s)

							elif cmd == 'chat':
								partner = data[1]
								print(data)
								sock.send(f"rqchat@{name}@{data[1]}".encode('ascii'))
								write_sockets.remove(s)
					else:
						data = input(f"{name}>>> ")
						data = f"sendchat@{name}@{partner}@{data}"
						if data:
							sock.send(data.encode('ascii'))
							write_sockets.remove(s)
			except:
				print("err1")

main()
