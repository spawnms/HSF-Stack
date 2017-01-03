for a in xrange(1, int(float(anzahl)+1)):
	print (str(a))
	os.system("python create_project.py "+name+" "+postfix+" "+str(a))
	#os.system("python create_subnet.py "+name+" "+ipadresse+" "+str(a))
	if netzwerk == 'true':
		os.system("python ../../create_subnet.py "+name+" "+str(a))
		os.system("python ../../create_router.py "+name+" "+str(a))