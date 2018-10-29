#!/usr/bin/python
#coding:utf-8

"""
@author: wenzhe
@software: PyCharm
@file: cleanDesktop.py
@time: 2018/10/19 8:03 PM
"""

#桌面的路径，我这里获取的是study文件夹下的路径

import os
import shutil


desktop = os.path.join(os.path.expanduser('~'), 'Desktop')

name = 'clean';
#input('输入整理后文件夹名字：')

clean = os.path.join(desktop, name)


#判断是否存在

flag = os.path.exists(clean)

#创建文件夹

if flag == False:
	os.mkdir(clean)

#获取文件

name_list = os.listdir(desktop)

#文件进行分类

for file in name_list:
	filePath = os.path.join(desktop, file)
	#判断是文件还是文件夹
	if not os.path.isfile(filePath):
		continue
	elif os.path.isfile(filePath):
		#分割文件名和扩展名
		fileExpand = os.path.splitext(file)[1]

		fileExpand = fileExpand[1:]
		#创建文件夹
		expand_file_name = os.path.join(clean, fileExpand)

		if not os.path.exists(expand_file_name):
			os.mkdir(expand_file_name)

		shutil.move(filePath, expand_file_name)
