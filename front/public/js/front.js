document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('crud-form');

    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', () => {
            form.querySelectorAll('.form-group').forEach(div => div.remove());
            form.querySelectorAll('.btn_data').forEach(button => button.remove());
            form.querySelectorAll('h3, h5').forEach(header => header.remove());
            switch (btn.dataset.type) {
                case 'create':
                    if (!form.querySelector('.form-group')) {
                        form.insertAdjacentHTML('beforeend', `
                            <div class="form-group">
                                <label for="nome">Nome Completo</label>
                                <input type="text" id="nome" name="nome" required placeholder="Digite o nome completo">
                            </div>

                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" name="cpf" required placeholder="Digite o CPF">
                            </div>

                            <div class="form-group">
                                <label for="idade">Idade</label>
                                <input type="number" id="idade" name="idade" required placeholder="Digite a idade">
                            </div>

                            <button type="button" class="btn btn-create btn_data" data-type="create_data">Salvar</button>
                        `);
                    }

                    break;
                case 'update':
                    if (!form.querySelector('.form-group')) {
                        form.insertAdjacentHTML('beforeend', `
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" id="id" name="id" required placeholder="Digite o id do registro que deseja atualizar">
                            </div>

                            <h3>Digite abaixo o dado que deseja atualizar</h3>
                            <h5>Deixe os campos que não deseja alterar em branco</h5>

                            <div class="form-group">
                                <label for="nome">Nome Completo</label>
                                <input type="text" id="nome" name="nome" placeholder="Digite o nome completo">
                            </div>

                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" name="cpf" placeholder="Digite o CPF">
                            </div>

                            <div class="form-group">
                                <label for="idade">Idade</label>
                                <input type="number" id="idade" name="idade" placeholder="Digite a idade">
                            </div>

                            <button type="button" class="btn btn-update btn_data" data-type="update_data">Atualizar</button>
                        `);
                    }
                    break;
                case 'delete':
                    if (!form.querySelector('.form-group')) {
                        form.insertAdjacentHTML('beforeend', `
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" id="id" name="id" required placeholder="Digite o id do registro que deseja apagar">
                            </div>

                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" name="cpf" required placeholder="Confirme o CPF do registro que deseja apagar">
                            </div>

                            <button type="button" class="btn btn-delete btn_data" data-type="delete_data">Apagar</button>
                        `);
                    }
                    break;
            }
        });

    });
});