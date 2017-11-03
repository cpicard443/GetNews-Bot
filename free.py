import requests
from bs4 import BeautifulSoup
contenu = ""
#On recupere l'inforamtion princpale du site Le Monde
req = requests.get("http://www.lemonde.fr/")
response = req.text
soup = BeautifulSoup(response)
all_tt3 = soup.find('h1',attrs={"class":u"tt3"})
contenu = all_tt3.getText().split()
string = "Le Monde: "
for loop in range(len(contenu)-1):
	string+=("%20")
	string+=contenu[loop]
#On envoie le messge
requeteFree = requests.get("https://smsapi.free-mobile.fr/sendmsg?user=********&pass=**********&msg="+string)  #remplacer les * par le numero d'utilisateur free et votre mot de passe free

#On récupere l'information la plus partagé sur le site du Figaro
req = requests.get("http://www.lefigaro.fr/")
response = req.text
soup = BeautifulSoup(response)
all_tt3 = soup.find('span',attrs={"class":u"fig-toparticles__item-title-inner"})
contenu = all_tt3.getText().split()
string = "Le Figaro: "
for loop in range(len(contenu)):
	string+=("%20")
	string+=contenu[loop]
#On envoie le message
requeteFree = requests.get("https://smsapi.free-mobile.fr/sendmsg?user=*******&pass=***********&msg="+string)#remplacer les * par le numero d'utilisateur free et votre mot de passe free

#On réupère la méteo a Orleans
req = requests.get("http://france.lachainemeteo.com/meteo-france/ville/previsions-meteo-orleans-3846-0.php")
response = req.text
soup = BeautifulSoup(response)
meteo = soup.find('div',attrs={"id":u"texte_description"})
contenu = meteo.getText().split()
string = "Meteo"
for loop in range(len(contenu)):
	string+=("%20")
	string+=contenu[loop]
#On envoie le message
requeteFree = requests.get("https://smsapi.free-mobile.fr/sendmsg?user=********&pass=**********&msg="+string)#remplacer les * par le numero d'utilisateur free et votre mot de passe free


