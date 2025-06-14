let menuItems = document.querySelectorAll(".addMenuItem");

menuItems.forEach(button => {
    button.addEventListener("click", (event) => {
        const dishId = event.target.value;
        const menuItemRow = document.querySelector(`.itemSelectedTable .menuItem_${dishId}`);
        const input = menuItemRow.querySelector("input");
        const body = menuItemRow.parentElement;

        input.value = parseInt(input.value || 0) + 1;
        if(input.value == 1){
            body.appendChild(menuItemRow);
        }

        menuItemRow.classList.remove("hidden");
        menuItemRow.classList.add("selected");

        // Update subtotal for this dish
        const price = parseFloat(menuItemRow.dataset.price);
        const subAmountEl = document.querySelector(`.menuItem_${dishId} .subAmount`);
        subAmountEl.innerHTML = (price * input.value).toFixed(2).replace(".", ",");

        // Update total amount by summing all selected subtotals
        updateTotalAmount();
    });
});

let selectedMenuItemsInput = document.querySelectorAll(".itemSelectedTable input");

selectedMenuItemsInput.forEach(input => {
    input.addEventListener("change", (event) => {
        const input = event.target;
        const dishId = input.name;
        const menuItemRow = document.querySelector(`.itemSelectedTable .menuItem_${dishId}`);
        const price = parseFloat(menuItemRow.dataset.price);

        if (input.value == 0) {
            menuItemRow.classList.add("hidden");
            menuItemRow.classList.remove("selected");
            document.querySelector(`.menuItem_${dishId} .subAmount`).innerHTML = price.toFixed(2).replace(".", ",");
        } else {
            menuItemRow.classList.add("selected");
            menuItemRow.classList.remove("hidden");
            document.querySelector(`.menuItem_${dishId} .subAmount`).innerHTML = (price * input.value).toFixed(2).replace(".", ",");
        }

        updateTotalAmount();
    });
});

function updateTotalAmount() {
    let selectedItems = document.querySelectorAll(".itemSelectedTable .selected .subAmount");
    let total = 0;

    selectedItems.forEach(el => {
        total += parseFloat(el.innerHTML.replace(",", "."));
    });

    document.querySelector(".totalAmount").innerHTML = total.toFixed(2).replace(".", ",");
}

let clearButton = document.querySelector("#clearOrder");

if (clearButton) {
    clearButton.addEventListener("click", () => {
        let selectedItems = document.querySelectorAll(".itemSelectedTable .selected");

        selectedItems.forEach(item => {
            item.classList.remove("selected");
            item.classList.add("hidden");
            item.querySelector("input").value = 0;
        });

        document.querySelector(".totalAmount").innerHTML = "0,00";
    });
} else {
    console.error("ERROR: No clear button found!");
}