# -*- coding: UTF-8 -*-
import MySQLdb
import queue
import time
import  os
class cloudPrintDB:
    def __init__(self):
        self.db = MySQLdb.connect("127.0.0.1", "root", "wslzd9877", "user", charset='utf8')
        self.mysql = self.db.cursor()
    def getDelOrders(self):
        deleted =  queue.Queue()
        len = self.mysql.execute("select * from delfiles")
        for i in range(len):
            one = self.mysql.fetchone()
            if(int(time.time())-86400 >= int(one[1])):
                deleted.put(one[0])
        return deleted

    def delOrders(self,wellDel):
        while wellDel.empty() == False:
            thisOrder = wellDel.get()
            self.mysql.execute("DELETE FROM orderInfo WHERE orderId='"+thisOrder+"'")
            self.mysql.execute("DELETE FROM delfiles WHERE orderId='" + thisOrder + "'")
            self.mysql.execute("select * from fileinfo where orderId='"+thisOrder+"'")
            file = self.mysql.fetchone()
            if file != None:
                file = file[1]
                self.mysql.execute("DELETE FROM fileinfo WHERE orderId='" + thisOrder + "'")
                if (self.mysql.execute("select * from fileinfo where filePath='" + file + "'") == 0):
                    os.remove("C:/phpStudy/PHPTutorial/"+file)
            else :
                self.mysql.execute("DELETE FROM fileinfo WHERE orderId='" + thisOrder + "'")
                self.db.commit()
a = cloudPrintDB()
a.delOrders(a.getDelOrders())
