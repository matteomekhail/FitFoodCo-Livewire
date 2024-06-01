def decode(message_file):
    # Legge il file e costruisce il dizionario di mappatura
    number_to_word = {}
    with open(message_file, 'r') as file:
        for line in file:
            number, word = line.strip().split()
            number_to_word[int(number)] = word

    # Crea la piramide di numeri e identifica i numeri rilevanti
    relevant_numbers = []
    step = 1
    current_number = 1
    while current_number in number_to_word:
        relevant_numbers.append(current_number)
        step += 1
        current_number += step

    # Costruisce il messaggio decodificato
    decoded_message = ' '.join(number_to_word[num] for num in relevant_numbers if num in number_to_word)

    return decoded_message

# Utilizzo della funzione
# Supponi che il file si chiami 'encoded_message.txt'
print(decode('encoded_message.txt'))


