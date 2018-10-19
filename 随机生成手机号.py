#!/usr/bin/python
#coding:utf-8

"""
@author: wenzhe
@software: PyCharm
@file: 随机生成手机号.py
@time: 2018/10/19 9:04 PM
"""

#手机号一般都是11位

#random

'''
电信：133 153 180

联通：166 130 131 155

移动：137 139 134 138

第一位数：1
第二位数：345678
第三位数：3:0-9  
		4:5,7,9  
		5:0-9  !4
		6:6
		7:0-9  !4,9
		8:0-9
后面8位随机产生		
'''
import random

#定义函数
def creat_phono():

	#第二位数
	second = [3, 4, 5, 6, 7, 8][random.randint(0, 4)]

	#根据第二位数获取第三位数
	dist = {
        3:random.randint(0,9),
        4:[5,7,9][random.randint(0, 2)],
		5:[i for i in range(10) if i != 4][random.randint(0, 8)],
		6:6,
		7:[i for i in range(10) if i not in [4, 9]][random.randint(0, 7)],
		8:random.randint(0,9)
	}[second]

	#获取后八位数
	eight = random.randint(10000000,99999999)

	phton_num = '1{}{}{}'.format(second, dist, eight)
	return phton_num

#调用函数
# tel_num = creat_phono()

num = input('请输入生成的数量')

for index in range(int(num)):
	print('第{}个电话号'.format(index+1)+creat_phono())

