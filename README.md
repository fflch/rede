Exemplo de requisição post com shell:

    curl --include --header "Authorization: 123" \
    -X POST -H "Content-Type: application/json" --data \
    '{"hostname": "008.054517","ip": "200.0.1.4","poe_type": "no","model": "hp_comware","local": "fcs","position": "RACK-A"}' \
    http://127.0.0.1:8000/api/equipamentos

Exemplo de requisição post com python:

    import requests
    import json

    url = 'http://127.0.0.1:8000/api/equipamentos'
    data = {"hostname": "008.054517",
            "ip": "200.0.1.4",
            "poe_type": "no",
            "model": "hp_comware",
            "local": "fcs",
            "position": "RACK-A"}
    headers = {'Authorization': '123'}

    r = requests.post(url, data=data, headers=headers)
    print(r.content)

Estrutura:

    equipamento -> porta -> snapshot -> macs
    
