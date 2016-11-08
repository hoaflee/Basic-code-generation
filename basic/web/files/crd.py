import os
print("Path at terminal when executing this file")
#print(os.getcwd() + "\n")

print os.path.dirname(os.path.abspath(__file__))
