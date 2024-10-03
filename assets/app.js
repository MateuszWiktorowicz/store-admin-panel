import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

document
  .querySelectorAll('.add_item_link')
  .forEach(btn => {
      btn.addEventListener("click", addFormToCollection)
  });


  function addFormToCollection(e) {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

    // Create a new card element
    const card = document.createElement('div');
    card.className = 'card text-white bg-success mb-3'; // Add Bootstrap card classes

    // Create the card header
    const cardHeader = document.createElement('div');
    cardHeader.className = 'card-header';
    cardHeader.textContent = 'Order Item'; // Set header text

    // Create the card body
    const cardBody = document.createElement('div');
    cardBody.className = 'card-body';

    // Create the inner HTML for the card body using the prototype
    cardBody.innerHTML = collectionHolder.dataset.prototype.replace(
        /__name__/g,
        collectionHolder.dataset.index
    );

    // Append header and body to the card
    card.appendChild(cardHeader);
    card.appendChild(cardBody);

    // Append the new card to the collection holder
    collectionHolder.appendChild(card);

    // Increment the index for the next form
    collectionHolder.dataset.index++;
}
