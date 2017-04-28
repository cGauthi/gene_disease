#!/home/cgauthi/anaconda/bin/python

import mysql.connector
import jinja2
import cgi

templateLoader = jinja2.FileSystemLoader(searchpath="/var/www/html/templates")

env = jinja2.Environment(loader=templateLoader)
template = env.get_template('assoc.html')

formData = cgi.FieldStorage()
match_term = formData.getvalue('gene_name')

## Relic data
## match_term = input("Which gene are you curious about? ")

def main(searchMe):
    search_term = str(searchMe)
    geneSymbol = '%' + search_term + '%'
    match_count = 0
    disease_names = []
    descriptions = []
    scores = []

    conn = mysql.connector.connect(user='cgauthi', password='Biologia1!2@',
            host='localhost', database='gene_disease')
    curs = conn.cursor()

    qry = ("select diseaseName, score from gene_disease "
            "where geneName like %s"
            "order by score DESC")
    curs.execute(qry, (geneSymbol ,))

    for result in curs:
        match_count += 1
        disease_names.append(result[0])
        scores.append(result[1])


    #for i in range(match_count):
    #   print("{0}\t{1}".format(disease_names[i], scores[i]))

    #print(match_count, "matches found! Listing in order of signficance.")

    print("Content-type: text/html\n\n")
    print(template.render(diseaseName = disease_names, desc = descriptions, score = scores, count = match_count))

    curs.close()
    conn.commit()

if __name__ == '__main__':
    main(match_term)
