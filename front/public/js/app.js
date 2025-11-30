document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('crud-form');
    const tableBody = document.getElementById('date_table');

    async function fetchTable() {
        try {
            const res = await fetch(`http://localhost/CRUD_GP/back/api/router/router.php?resource=pessoa`); //OBS: eu poderia ter usado router.php/pessoa, mais para evitar incompatibilidade e ter que ajustar arquivos do servidor, optei por usar query string mesmo.

            if (!res.ok) {
                throw new Error(`Erro na requisição: ${res.status} - ${res.statusText}`);
            }

            const data = await res.json();
            tableBody.innerHTML = '';

            if (data.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="6" style="text-align:center;">Nenhum registro encontrado</td></tr>`;
                return;
            }

            data.forEach(p => {
                const tr = document.createElement('tr');
                tr.insertAdjacentHTML('beforeend', `
                <td>${p.id}</td>
                <td>${p.nome}</td>
                <td>${p.cpf}</td>
                <td>${p.idade}</td>
                <td>${p.data_criacao}</td>
            `);
                tableBody.appendChild(tr);
            });

        } catch (err) {
            console.error(err);
            tableBody.innerHTML = `<tr><td colspan="6" style="text-align:center; color:red;">Erro ao carregar os dados</td></tr>`;
        }

    }


    form.addEventListener('click', async (e) => {
        if (!e.target.classList.contains('btn_data')) return;

        const btn = e.target;
        const data = {
            nome: form.querySelector('[name="nome"]')?.value || null,
            cpf: form.querySelector('[name="cpf"]')?.value || null,
            idade: form.querySelector('[name="idade"]')?.value || null,
            id: form.querySelector('[name="id"]')?.value || null,
            token_name: form.querySelector('[name="token_name"]').value
        };
        let url = 'http://localhost/CRUD_GP/back/api/router/router.php';
        let method = 'POST';

        switch (btn.dataset.type) {
            case 'create_data':
                if (!data.nome) { alert('Digite o Nome!'); return; }
                if (!data.cpf) { alert('Digite o cpf!'); return; }
                if (!data.idade) { alert('Digite a idade!'); return; }
                method = 'POST';
                url += '?resource=pessoa';
                break;

            case 'update_data':
                if (!data.id) { alert('Digite o ID!'); return; }
                if (!data.nome && !data.cpf && !data.idade) { alert('Todos campos em branco'); return; }
                method = 'PUT';
                url += `?resource=pessoa&id=${data.id}`;
                break;

            case 'delete_data':
                if (!data.id) { alert('Digite o ID!'); return; }
                if (!data.cpf) { alert('Digite o cpf!'); return; }
                const confirmed = confirm(`Tem certeza que deseja apagar o registro de ID ${data.id}?`);
                if (!confirmed) return;
                method = 'DELETE';
                url += `?resource=pessoa&id=${data.id}`;
                break;
        }


        const options = { method };
        if (method === 'POST' || method === 'PUT' || method === 'DELETE') {
            options.headers = { 'Content-Type': 'application/json' };
            options.body = JSON.stringify(data);
        }

        try {
            const res = await fetch(url, options);
            const result = await res.json();
            console.log(result);

            if (result.success === false && result.message === 'CPF já cadastrado!') {
                alert(result.message);
                return; 
            }

            fetchTable();
            form.reset();
        } catch (err) {
            console.error(err);
            alert('Erro ao processar requisição');
        }
    });



    fetchTable();
    setInterval(fetchTable, 5000);
});