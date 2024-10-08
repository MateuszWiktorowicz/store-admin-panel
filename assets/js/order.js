document
  .querySelectorAll('.add_item_link')
  .forEach(btn => {
      btn.addEventListener("click", addFormToCollection)
  });


  function addFormToCollection(e) {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);


    const card = document.createElement('div');
    card.className = 'card text-white bg-success mb-3'; 


    const cardHeader = document.createElement('div');
    cardHeader.className = 'card-header';
    cardHeader.textContent = 'Order Item'; 


    const cardBody = document.createElement('div');
    cardBody.className = 'card-body';


    cardBody.innerHTML = collectionHolder.dataset.prototype.replace(
        /__name__/g,
        collectionHolder.dataset.index
    );


    card.appendChild(cardHeader);
    card.appendChild(cardBody);


    collectionHolder.appendChild(card);


    collectionHolder.dataset.index++;
}