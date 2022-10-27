<div class="shadow rounded mt-5 px-4 pb-2">
    
    <table class="table table-striped table-hover">

        <h2 class="p-3 text-center fs-3">Lista de contatos</h2>

        <button class="btn btn-outline-primary mb-2" id="btnCreate" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa-solid fa-plus"></i> Create</button>
    
        <thead>
            <tr class="text-center text-light bg-indigo">
                <th class=" rounded-top-left" scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Sex</th>
                <th scope="col">Telephone</th>
                <th class=" rounded-top-right" scope="col"><i class="fa-solid fa-screwdriver-wrench"></i></th>
            </tr>
        </thead>
    
        <tbody>
            <?php
                use App\Http\Models\Contact;

                $ContactModel = new Contact();
                $contacts = $ContactModel->get();
                
                if ($contacts) {
                    foreach ($contacts as $contact) {
                        ?>
                            <tr>
                                <th class="table-light"><?php echo $contact->id ?></th>
                                <td class="table-light text-center"><?php echo $contact->name ?></td>
                                <td class="table-light text-center"><?php echo $contact->age ?></td>
                                <td class="table-light text-center"><?php echo $contact->sex ?></td>
                                <td class="table-light text-center"><?php echo $contact->telephone ?></td>
                                <td class="table-light text-center d-flex justify-content-center">
                                    <form action="../../Http/Models/Contato.php" method="post">
                                        <input type="hidden" name="acao" value="excluir">
                                        <button type="submit" class="btn btn-danger" name="id" value="<?php echo $contact->id ?>"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                    <a class="btn btn-primary" href="alterar-contato.php?id=<?php echo $contact->id ?>"><i class="fa-solid fa-pencil"></i></a>
                                </td>
                            </tr>
                        <?php
                    }
                }
            ?>
        </tbody>
    
    </table>

</div>