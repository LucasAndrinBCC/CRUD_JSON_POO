<div class="shadow rounded mt-5 px-4 pb-2">
    
    <table class="table table-striped table-hover">

        <h2 class="p-3 text-center fs-3">Lista de contatos</h2>

        <button class="btn btn-outline-primary mb-2" id="btnCreate" data-bs-toggle="modal" data-bs-target="#modal"><i class="fa-solid fa-plus"></i> Create</button>
        
        <div class="input-group mb-2">
            <button class="btn btn-outline-primary" id="btnSearch"><i class="fa-solid fa-magnifying-glass"></i>Search</button>
            <input type="text" name="search" id="inputSearch" class="form-control">
        </div>
    
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
    
        <tbody id="content">
            <!-- Content -->
        </tbody>
    
    </table>

    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-id="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-2 mb-md-3 mb-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do contato">
                            <label for="username">Nome</label>
                            <div class="invalid-feedback">
                                Informe um nome!
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="idade" id="idade" placeholder="Idade do contato">
                            <label for="idade">Idade</label>
                            <div class="invalid-feedback">
                                Informe uma idade!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone do contato">
                            <label for="telefone">Telefone</label>
                            <div class="invalid-feedback">
                                Informe um telefone!
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="radio" name="sexo" role="switch" id="masculino" value="masculino">
                            <label class="form-check-label" for="masculino">
                                Masculino
                            </label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="radio" name="sexo" role="switch" id="feminino" value="feminino">
                            <label class="form-check-label" for="feminino">
                                Feminino
                            </label>
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="save" data-action="" data-bs-dismiss="modal" aria-label="Close">Salvar</button>
                </div>
            </div>
        </div>
    </div>

</div>