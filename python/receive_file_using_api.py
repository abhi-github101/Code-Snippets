from flask import Flask
from flask import request
from flask_restful import Resource
from flask_restful import Api
from os import makedirs

app = Flask(__name__)
api = Api(app)

class Receive(Resource):
    def post(self):
        file = request.files['file']
        if file:
            filename = file.filename
            cwd = "./files/"
            file.save(open(cwd+"/"+filename,"wb"))
            return

api.add_resource(Receive, '/rcv_code')


if __name__ == '__main__':
    app.run(host='127.0.0.1', port='6005')
