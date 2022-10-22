function toggleInput(input, add, remove) {
    input.classList.add(add)
    input.classList.remove(remove)
}

function toggleInputVerify(input, add, remove) {
    if (input.length) {
        input.forEach((subInput) => {
            toggleInput(subInput, add, remove)
        })
    } else {
        toggleInput(input, add, remove)
        toggleInput(input.parentElement, add, remove)
    }
}

document.getElementById("form").addEventListener('submit', function (event) {

    let valid = true
    let inputs = [
        this.elements['nome'],
        this.elements['idade'],
        this.elements['telefone'],
        this.elements['sexo']
    ];

    inputs.forEach((input) => {
        let campoValido = input.value.trim() != ''

        if (campoValido) {
            toggleInputVerify(input, "is-valid", "is-invalid")
        } else {
            toggleInputVerify(input, "is-invalid", "is-valid")
        }

        valid = valid && campoValido
    });

    if (!valid) {
        event.preventDefault()
    }
});