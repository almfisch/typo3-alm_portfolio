TYPO3 Portfolio Extension


TS Settings:

plugin.tx_almportfolio {
	settings {
		# template.list = fileadmin/template/portfolio_list.html
		# template.cloud = fileadmin/template/portfolio_cloud.html
		# template.menu = fileadmin/template/portfolio_menu.html
		# template.detail = fileadmin/template/portfolio_detail.html
		# template.select.1 = fileadmin/template/portfolio_list_1.html
		# template.select.2 = fileadmin/template/portfolio_list_2.html
		imgList.width = 160
		imgList.height = 80
		imgDetail.width = 320
		imgDetail.height = 160
	}
}

##################################################################

Template Vars:

settings
categories
items
item

##################################################################

ToDo / Ideen:

Template-Auswahl pro Referenz (z.B. Referenz, Case Study)
�hnliche Referenzen ausw�hlbar pro Referenz
irgendwie die M�glichkeit unterhalb der Detailansicht weitere Referenzen anzuzeigen (mit Bezug irgendwie)
Weitere Felder, z.B. Grafiker...
Feld f�r Sortierung
Category => Feld: alias
Mehrere Felder: Text 1, Text 2, HTML 1 HTML 2
Weiteres Feld f�r Kundenstimmen (extra DB Table)