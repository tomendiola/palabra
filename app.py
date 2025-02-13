from flask import Flask, request, jsonify
from flask_cors import CORS

app = Flask(__name__)
CORS(app)  # Permitir peticiones desde cualquier origen

@app.route('/api', methods=['POST'])
def contar_letras():
    data = request.get_json()
    
    if not data or 'palabra' not in data:
        return jsonify({"error": "No se recibió ninguna palabra."}), 400
    
    palabra = data["palabra"].strip()
    cantidad_letras = len(palabra)

    return jsonify({"palabra": palabra, "cantidad_letras": cantidad_letras})

if __name__ == '__main__':
    app.run(debug=True)
