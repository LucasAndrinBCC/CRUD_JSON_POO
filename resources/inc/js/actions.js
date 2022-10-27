$(() => {    
    function getContacts(param = false) {
        let url = 'actions.php';
        if (param) {
            url += `?name=${param}`;
        }

        $.ajax(url, {
            success: function (response) {

                let contacts = JSON.parse(response);

                let content = ``;

                contacts.forEach(contact => {
                    content += `
                    <tr>
                        <th class="table-light">${contact.id}</th>
                        <td class="table-light text-center">${contact.name}</td>
                        <td class="table-light text-center">${contact.age}</td>
                        <td class="table-light text-center">${contact.sex}</td>
                        <td class="table-light text-center">${contact.telephone}</td>
                        <td class="table-light text-center d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btnUpdate" data-id="${contact.id}" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa-solid fa-pencil"></i></button>
                            <button type="button" class="btn btn-danger btnDelete" data-id="${contact.id}"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>`;
                });

                $('#content').html(content);

                function deleteContact(id) {
                    $.ajax({
                        url: `actions.php?id=${id}`,
                        type: 'DELETE',
                        success: function () {
                            getContacts();
                        }
                    })
                }

                $('.btnDelete').click(function (){
                    deleteContact($(this).data("id"));
                });
            
                $('.btnUpdate').click(function () {
                    $('#modalLabel').html('Update Contact');
                    let save = $('#save');
                    save.attr("data-id");
                    save.attr("data-action");
                    save.data('id', $(this).data("id"));
                    save.data('action', "update");
                });

            }
        });     
    }
    getContacts();

    function updateContact(id, data) {
        $.ajax({
            url: `actions.php`,
            data: {
                'id': id,
                'name': data.name,
                'age': data.age,
                'sex': data.sex,
                'telephone': data.telephone
            },
            type: 'PUT',
            success: function () {
                getContacts();
            }
        })
    }

    function createContact(data) {
        $.ajax({
            url: `actions.php`,
            data: {
                'name': data.name,
                'age': data.age,
                'sex': data.sex,
                'telephone': data.telephone
            },
            type: 'POST',
            success: function (response) {
                getContacts();
            }
        });
    }

    $('#btnCreate').click(function () {
        $('#modalLabel').html('Create Contact');
        let save = $('#save');
        save.attr("data-action");
        save.data('action', "create");
    });

    $('#btnSearch').click(function () {
        let param = $('#inputSearch').val();
        getContacts(param);
    });

    $('#save').click(function () {
        let action = $(this).data("action");
        let modal = $('#modal');
        let inputName = modal.find('#nome');
        let inputAge = modal.find('#idade');
        let inputSexo = modal.find('input[name=sexo]:checked');
        let inputTelephone = modal.find('#telefone');
        let data = {
            name: inputName.val(),
            age: inputAge.val(),
            sex: inputSexo.val(),
            telephone: inputTelephone.val()
        };

        if (action == "update") {
            updateContact($('#save').data('id'), data);
        } else if (action == "create") {
            createContact(data);
        }

        inputName.val("");
        inputAge.val("");
        inputSexo.prop('checked', false);
        inputTelephone.val("");
    });
});