$(document).ready(function () {

    class ContactRepository {
        getContacts() {
            $.ajax('actions.php', {
                success: function (contacts) {
                    
                    $('content').html();

                    let content = ``;

                    contacts.forEach(contact => {
                        content += `
                        <tr>
                            <th class="table-light">${contact.id}</th>
                            <td class="table-light text-center">${contact.name}</td>
                            <td class="table-light text-center">${contact.age}</td>
                            <td class="table-light text-center">${contact.sex}></td>
                            <td class="table-light text-center">${contact.telephone}</td>
                            <td class="table-light text-center d-flex justify-content-center">
                                <form action="../../Http/Models/Contato.php" method="post">
                                    <input type="hidden" name="acao" value="excluir">
                                    <button type="submit" class="btn btn-danger" name="id" value="<?php echo $contact->id ?>"><i class="fa-solid fa-trash"></i></button>
                                </form>
                                <a class="btn btn-primary" href="alterar-contato.php?id=<?php echo $contact->id ?>"><i class="fa-solid fa-pencil"></i></a>
                            </td>
                        </tr>`;
                    });
                    // <tr>
                    //     <th class="table-light"><?php echo $contact->id ?></th>
                    //     <td class="table-light text-center"><?php echo $contact->name ?></td>
                    //     <td class="table-light text-center"><?php echo $contact->age ?></td>
                    //     <td class="table-light text-center"><?php echo $contact->sex ?></td>
                    //     <td class="table-light text-center"><?php echo $contact->telephone ?></td>
                    //     <td class="table-light text-center d-flex justify-content-center">
                    //         <form action="../../Http/Models/Contato.php" method="post">
                    //             <input type="hidden" name="acao" value="excluir">
                    //             <button type="submit" class="btn btn-danger" name="id" value="<?php echo $contact->id ?>"><i class="fa-solid fa-trash"></i></button>
                    //         </form>
                    //         <a class="btn btn-primary" href="alterar-contato.php?id=<?php echo $contact->id ?>"><i class="fa-solid fa-pencil"></i></a>
                    //     </td>
                    // </tr>
                }
            });
        }

        createContact() {
            $.ajax({
                url: `actions.php`,
                data: {
                    'name': 'Lucas',
                    'age': 19,
                    'sex': 'Masculino',
                    'telephone': '21312312'
                },
                type: 'POST',
                success: function (response) {
                    console.log(response);
                }
            });
        }
    }

    const contactRepositoryInstance = new ContactRepository();

    contactRepositoryInstance.getContacts();
    contactRepositoryInstance.createContact();

});