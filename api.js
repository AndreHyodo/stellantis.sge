// Função para buscar os dados da API
async function fetchData() {
  try {
    const response = await fetch('https://andrehyodo.github.io/stellantis.sge/causais/causais.json');
    const data = await response.json();
    return data.causais;
  } catch (error) {
    console.error('Erro ao buscar dados da API:', error);
  }
}

function hideNextSiblings() {
  const toggleButtons = document.querySelectorAll('.toggle-data-btn');

  toggleButtons.forEach(toggleButton => {
    const cardBody = toggleButton.parentNode.nextElementSibling;
    cardBody.style.display = 'none';
  });
}

// Função para exibir os dados na página
function renderData(data) {
  const container = document.getElementById('data-container');

  const groupedData = groupByType(data);

  Object.keys(groupedData).forEach(type => {
    const col = document.createElement('div');
    col.className = 'col-md-3';

    const card = document.createElement('div');
    card.className = 'card mb-3';

    const cardBody = document.createElement('div');
    cardBody.className = 'card-body';

    const cardTitle = document.createElement('h5');
    cardTitle.className = 'card-title';
    cardTitle.textContent = type;

    // Botão de mostrar/ocultar dados
    const toggleButton = document.createElement('button');
    toggleButton.className = 'btn btn-primary btn-sm toggle-data-btn';
    toggleButton.textContent = '+';
          

    cardTitle.appendChild(toggleButton);
    cardBody.appendChild(cardTitle);

    const list = document.createElement('ul');

    groupedData[type].forEach(item => {
      const listItem = document.createElement('li');

      const checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.value = item.causal;
      //checkbox.style.display = 'none';
      checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
          document.getElementById('causal').value = item.causal;
        } else {
          document.getElementById('causal').value = '';
        }
      });

      const causalText = document.createElement('span');
      causalText.textContent = item.causal + "    ";
      //causalText.style.display = 'none';

      const descriptionMarker = document.createElement('span');
      descriptionMarker.className = 'description-marker';
      //descriptionMarker.style.display = 'none';

      const svgIcon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
      svgIcon.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
      svgIcon.setAttribute('width', '16');
      svgIcon.setAttribute('height', '16');
      svgIcon.setAttribute('viewBox', '0 0 16.93 16.93');
      svgIcon.setAttribute('version', '1.1');

      const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
      path.setAttribute('d', 'M8.51,0C3.83-.02.02,3.75+0,8.42c-.02,4.68+3.75,8.49+8.42,8.51+4.68.02+8.49-3.75+8.51-8.42C16.96,3.83+13.18.02+8.51,0Zm-.12,2.28c.41,0+.75.15+1.03.44.29.28.43.63.43,1.04+0+.41-.14.75-.43,1.04-.28.28-.63.42-1.03.42-.42,0-.76-.14-1.05-.42C7.06,4.52+6.91,4.17+6.91,3.76+6.91,3.34+7.06,3+7.35,2.72+7.63,2.43+7.98,2.28+8.39,2.28ZM6,6.07h3.89v7.25h1.17v.93H6V13.32H7.16V7H6Z');

      svgIcon.appendChild(path);
      descriptionMarker.appendChild(svgIcon);

      const description = document.createElement('span');
      description.className = 'description';
      description.textContent = item.description;

      listItem.appendChild(checkbox);
      listItem.appendChild(causalText);
      listItem.appendChild(descriptionMarker);
      listItem.appendChild(description);
      list.appendChild(listItem);
    });



    cardBody.appendChild(list);
    card.appendChild(cardBody);
    col.appendChild(card);

    container.appendChild(col);
    
  });
  
}


 // Evento de clique no botão de mostrar/ocultar dados
 document.addEventListener('click', function (event) {
  if (event.target.matches('.toggle-data-btn')) {
    const cardBody = event.target.parentNode.nextElementSibling;
    const toggleBtnText = event.target.textContent;

    if (toggleBtnText === '+') {
      event.target.textContent = '-';
      cardBody.style.display = 'block';
    } else {
      event.target.textContent = '+';
      cardBody.style.display = 'none';
    }
  }
});

// Função auxiliar para agrupar os dados por tipo
function groupByType(data) {
  const groupedData = {};

  data.forEach(item => {
    if (!groupedData[item.type]) {
      groupedData[item.type] = [];
    }
    groupedData[item.type].push(item);
  });

  return groupedData;
}






// Chamar a função para buscar e exibir os dados
fetchData().then(data => {
renderData(data);  

// Chamar a função para ocultar os siblings dos .toggle-data-btn
hideNextSiblings();
});
