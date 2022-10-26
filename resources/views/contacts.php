<div class="shadow rounded mt-5 px-4 pb-2">

    <table class="table tabled-dark table-striped table-hover">
    
        <thead>
            <tr>
                <th colspan="5" class="text-center border-bottom-0 fs-3">
                    Lista de contatos
                </th>
            </tr>
            <tr>
                <th class="table-dark bg-indigo rounded-top-left" scope="col">#</th>
                <th class="table-dark bg-indigo text-center" scope="col">Nome</th>
                <th class="table-dark bg-indigo text-center" scope="col">Idade</th>
                <th class="table-dark bg-indigo text-center" scope="col">Sexo</th>
                <th class="table-dark bg-indigo text-center" scope="col">Telefone</th>
                <th class="table-dark bg-indigo text-center rounded-top-right" scope="col"><i class="fa-solid fa-screwdriver-wrench"></i></th>
            </tr>
        </thead>
    
        <tbody>
            <?php
                use App\Http\Models\Contact;

                $contatos = Contact::get();
                
                if ($contatos) {
                    foreach ($contatos as $key => $contato) {
                        ?>
                            <tr>
                                <th class="table-light"><?php echo $key ?></th>
                                <td class="table-light text-center"><?php echo $contato->nome ?></td>
                                <td class="table-light text-center"><?php echo $contato->idade ?></td>
                                <td class="table-light text-center"><?php echo $contato->sexo ?></td>
                                <td class="table-light text-center"><?php echo $contato->telefone ?></td>
                                <td class="table-light text-center d-flex justify-content-center">
                                    <form action="../../Http/Models/Contato.php" method="post">
                                        <input type="hidden" name="acao" value="excluir">
                                        <button type="submit" class="btn btn-danger" name="id" value="<?php echo $key ?>"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                    <a class="btn btn-primary" href="alterar-contato.php?id=<?php echo $key ?>"><i class="fa-solid fa-pencil"></i></a>
                                </td>
                            </tr>
                        <?php
                    }
                }
            ?>
        </tbody>
    
    </table>

</div>