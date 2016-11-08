#!/usr/bin/env python
import sqlite3
import csv
import glob
import os

def get_all_databaseFile(directory):
	files=glob.glob(directory+'/*.db')
	return files

def connect_Data(dbName):
	conn=sqlite3.connect('%s'%(dbName))
	c=conn.cursor()
	return c

def get_all_table(dbName):
	c = connect_Data(dbName)
	cursor = c.execute("SELECT name FROM sqlite_master WHERE type='table'")
	return [row[0] for row in cursor]

def get_column_header(dbName,tbName):
	c = connect_Data(dbName)
	cursor=c.execute('PRAGMA table_info(%s)' %(tbName))
	return [row[1] for row in cursor]

def get_data(dbName,tbName):
	c = connect_Data(dbName)
	cursor=c.execute('SELECT * FROM %s' %(tbName))
	return [row for row in cursor]

def export(dbName,tbName):
	directory = os.path.dirname(dbName)
	parent_folder_name=get_databaseFileName(dbName)
	converted_folder = directory + '/DatabaseConvert/'+parent_folder_name
	if not os.path.exists(converted_folder):
		os.makedirs(converted_folder)
	outfile = open(converted_folder+'/%s_%s.csv' %(parent_folder_name,tbName), 'wb')
	writer = csv.writer(outfile)
	writer.writerow(get_column_header(dbName, tbName))
	writer.writerows(get_data(dbName, tbName))
	outfile.close()

def get_databaseFileName(dbName):
	dbFilename = os.path.basename(dbName)
	return dbFilename.split('.')[0]
try:
	directory = raw_input('Insert directory containing files: ')
	#directory='/home/hoanghoa/Documents/driveRightConvert'
	dbFiles = get_all_databaseFile(directory)
	for dbFile in dbFiles:
		names = get_all_table(dbFile)
		for name in names:
			export(dbFile,name)
except IOError as e:
    	print "Error({0}): {1}".format(e.errno, e.strerror)

print 'Well done, Convert completed!!'


