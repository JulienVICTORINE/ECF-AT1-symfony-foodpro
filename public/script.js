// Données de test
const dishesData = [
  // Entrées
  {
    id: 1,
    name: "Salade César",
    price: 12,
    chef: "Marie Dubois",
    category: "Entrées",
    description:
      "Salade romaine croquante, croûtons dorés, parmesan et sauce César maison",
  },
  {
    id: 2,
    name: "Soupe de potiron",
    price: 8,
    chef: "Jean Martin",
    category: "Entrées",
    description:
      "Velouté de potiron onctueux aux épices douces et crème fraîche",
  },
  {
    id: 3,
    name: "Carpaccio de bœuf",
    price: 16,
    chef: "Marie Dubois",
    category: "Entrées",
    description:
      "Fines lamelles de bœuf, roquette, copeaux de parmesan et huile de truffe",
  },
  {
    id: 4,
    name: "Bruschetta",
    price: 10,
    chef: "Jean Martin",
    category: "Entrées",
    description:
      "Pain grillé garni de tomates fraîches, basilic et mozzarella di bufala",
  },

  // Plats
  {
    id: 5,
    name: "Bœuf bourguignon",
    price: 24,
    chef: "Marie Dubois",
    category: "Plats",
    description:
      "Bœuf mijoté au vin rouge avec légumes et garniture traditionnelle",
  },
  {
    id: 6,
    name: "Saumon grillé",
    price: 22,
    chef: "Jean Martin",
    category: "Plats",
    description:
      "Filet de saumon grillé, légumes de saison et sauce hollandaise",
  },
  {
    id: 7,
    name: "Risotto aux champignons",
    price: 18,
    chef: "Marie Dubois",
    category: "Plats",
    description:
      "Riz arborio crémeux aux cèpes et champignons de Paris, parmesan",
  },
  {
    id: 8,
    name: "Coq au vin",
    price: 26,
    chef: "Jean Martin",
    category: "Plats",
    description: "Coq fermier mijoté au vin blanc avec lardons et champignons",
  },

  // Desserts
  {
    id: 9,
    name: "Tiramisu",
    price: 8,
    chef: "Marie Dubois",
    category: "Desserts",
    description: "Dessert italien traditionnel au mascarpone, café et cacao",
  },
  {
    id: 10,
    name: "Tarte tatin",
    price: 7,
    chef: "Jean Martin",
    category: "Desserts",
    description:
      "Tarte aux pommes caramélisées servie tiède avec crème fraîche",
  },
  {
    id: 11,
    name: "Crème brûlée",
    price: 9,
    chef: "Marie Dubois",
    category: "Desserts",
    description: "Crème vanillée avec croûte de sucre caramélisé craquante",
  },
  {
    id: 12,
    name: "Mousse au chocolat",
    price: 6,
    chef: "Jean Martin",
    category: "Desserts",
    description: "Mousse légère au chocolat noir 70% et chantilly maison",
  },
];

// Elements du DOM
const searchInput = document.getElementById("search-input");

let currentCategory = "Toutes";

const btnToutesCategories = document.getElementById("btnToutesCategorie");
const btnCategoriesEntrees = document.getElementById("btnCategoriesEntrees");
const btnCategoriesPlats = document.getElementById("btnCategoriesPlats");
const btnCategoriesDesserts = document.getElementById("btnCategoriesDesserts");

const btnTousLesPrix = document.getElementById("btnTousLesPrix");
const btnPrixAsc = document.getElementById("btnPrixAsc");
const btnPrixDesc = document.getElementById("btnPrixDesc");

const rangeInput = document.getElementById("range-input");
const rangeValue = document.getElementById("range-value");

const foodGrid = document.getElementById("food-grid");

let dishes = [...dishesData];

// slice
var numberOfDishes = 12;

// sort
var sortMethod = "";

function displayDishesData() {
  foodGrid.innerHTML = "";

  let copyDishes = [...dishes];

  if (searchInput.value) {
    copyDishes = copyDishes.filter((dishe) =>
      dishe.name.toLocaleLowerCase().includes(searchInput.value)
    );
  }

  if (currentCategory !== "Toutes") {
    copyDishes = copyDishes.filter(
      (dishe) => dishe.category == currentCategory
    );
  }

  // sort
  if (sortMethod) {
    copyDishes.sort((a, b) => {
      if (sortMethod == "prixDesc") {
        return a.price - b.price;
      } else if (sortMethod == "prixAsc") {
        return b.price - a.price;
      }
    });
  }

  // range
  copyDishes = copyDishes.slice(0, numberOfDishes);

  // Affichage des données
  copyDishes.forEach((dishe) => {
    foodGrid.innerHTML += `
        <div class="food-card">
          <h3>${dishe.name}</h3>
          <p class="prix-plat"><strong>${dishe.price}</strong></p>
          <p><span class="badge">${dishe.category}</span></p>
          <p class="chef">Chef : ${dishe.chef}</p>
        </div>
        `;
  });
}

// Événements
// Rechercher un repas
searchInput.addEventListener("input", displayDishesData);

// affiche une portion des repas
rangeInput.addEventListener("input", (e) => {
  rangeValue.innerHTML = e.target.value;
  numberOfDishes = e.target.value;
  displayDishesData();
});

// Trier pa prix dans l'ordre croissant
btnPrixAsc.addEventListener("click", () => {
  sortMethod = "prixAsc";
  displayDishesData();
});

// Trier par prix dans l'ordre décroissant
btnPrixDesc.addEventListener("click", () => {
  sortMethod = "prixDesc";
  displayDishesData();
});

// ============================================== //

// Trie pour afficher toutes les catégories
btnToutesCategories.addEventListener("click", () => {
  currentCategory = "Toutes";
  displayDishesData();
});

// Trie pour afficher les repas par prix par défaut
btnTousLesPrix.addEventListener("click", () => {
  sortMethod = "";
  displayDishesData();
});

// Trie pour afficher les entrées
btnCategoriesEntrees.addEventListener("click", () => {
  currentCategory = "Entrées";
  displayDishesData();
});

// Trie pour afficher les plats
btnCategoriesPlats.addEventListener("click", () => {
  currentCategory = "Plats";
  displayDishesData();
});

// Trie pour afficher les desserts
btnCategoriesDesserts.addEventListener("click", () => {
  currentCategory = "Desserts";
  displayDishesData();
});

displayDishesData();
