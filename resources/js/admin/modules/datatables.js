import DataTable from "datatables.net-bs5";

let productCategoriesTable = new DataTable('#categories-table', {
    responsive: true,
});

let ordersTable = new DataTable('#orders-table', {
    responsive: true
});
