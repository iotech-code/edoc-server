import requests
url = "http://localhost:8009/api/login"
data ={
    'user_id': 'admin@sh1',
    'passowrd': 'secret'
}
headers = {
    'Content-Type': "application/json"
}

res = requests.post(url, data=data, headers=headers)

print (res)