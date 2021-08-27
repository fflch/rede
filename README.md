Exemplo de requisição post:

    curl --include --header "Authorization: 123" \
        --data '{ \
                  "name": "blog", \
                  "auto_init": true, \
                  "private": true, \
                  "gitignore_template": "nanoc" \
                 }' \
        http://127.0.0.1:8000/api/snapshot

