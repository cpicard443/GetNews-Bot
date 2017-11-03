import requests
from bs4 import BeautifulSoup
contenu = ""
req = requests.get("http://www.lemonde.fr/")
response = req.text
#requete = Request("http://www.lemonde.fr/")
#response = urlopen(requete)
soup = BeautifulSoup(response)
all_tt3 = soup.find('h1',attrs={"class":u"tt3"})
print("news!!!")
contenu = all_tt3.getText().split()
print(contenu)
string = "Le Monde: "
for loop in range(len(contenu)-1):
	string+=("%20")
	string+=contenu[loop]
requeteFree = requests.get("https://smsapi.free-mobile.fr/sendmsg?user=93147022&pass=nWLh2vDzDRr8kN&msg="+string)


req = requests.get("http://www.lefigaro.fr/")
response = req.text
soup = BeautifulSoup(response)
all_tt3 = soup.find('span',attrs={"class":u"fig-toparticles__item-title-inner"})
print("news!!!")
contenu = all_tt3.getText().split()
print(contenu)
string = "Le Figaro: "
for loop in range(len(contenu)):
	string+=("%20")
	string+=contenu[loop]
requeteFree = requests.get("https://smsapi.free-mobile.fr/sendmsg?user=93147022&pass=nWLh2vDzDRr8kN&msg="+string)

req = requests.get("http://france.lachainemeteo.com/meteo-france/ville/previsions-meteo-orleans-3846-0.php")
response = req.text
soup = BeautifulSoup(response)
meteo = soup.find('div',attrs={"id":u"texte_description"})
contenu = meteo.getText().split()
print(contenu)
string = ""
for loop in range(len(contenu)):
	string+=("%20")
	string+=contenu[loop]
requeteFree = requests.get("https://smsapi.free-mobile.fr/sendmsg?user=93147022&pass=nWLh2vDzDRr8kN&msg="+string)

