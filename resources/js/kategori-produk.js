export default function kategoriProduk() {
    return {
        showCategoriesModal: false,
        showCategoryOptions: false,
        showAddCategoryModal: false,
        showDeleteCategoryModal: false,

        showConfirmAddCategory: false,
        showConfirmDeleteCategory: false,

        showSuccessModal: false,
        showErrorModal: false,

        categories: [],
        selectedCategories: [],
        deletingCategories: false,

        successMessage: '',
        errorMessage: '',

        newCategory: {
            nama_kategori: '',
            deskripsi: ''
        },

        async loadCategories() {
            try {
                const response = await fetch(
                    window.kategoriProdukRoutes.index,
                    {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                );

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Gagal mengambil kategori.'
                    );
                }

                this.categories = data;
                this.showCategoriesModal = true;

            } catch (error) {
                console.error(error);
                this.showError(error.message);
            }
        },

        openAddCategory() {
            this.showAddCategoryModal = false;
            this.showConfirmAddCategory = true;
        },

        confirmAddCategory() {
            this.showConfirmAddCategory = false;
            this.addCategory();
        },

        async addCategory() {
            try {
                const formData = new FormData();

                formData.append(
                    'nama_kategori',
                    this.newCategory.nama_kategori
                );

                formData.append(
                    'deskripsi',
                    this.newCategory.deskripsi
                );

                formData.append(
                    '_token',
                    window.kategoriProdukRoutes.csrf
                );

                const response = await fetch(
                    window.kategoriProdukRoutes.store,
                    {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    }
                );

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Gagal menambahkan kategori.'
                    );
                }

                this.categories.push(data.kategori);

                this.newCategory = {
                    nama_kategori: '',
                    deskripsi: ''
                };

                this.showSuccess(data.message);

            } catch (error) {
                console.error(error);
                this.showError(error.message);
            }
        },

        openDeleteCategory() {
            if (this.selectedCategories.length === 0) {
                this.showError(
                    'Pilih minimal satu kategori terlebih dahulu.'
                );
                return;
            }   

            this.showDeleteCategoryModal = false;
            this.showConfirmDeleteCategory = true;
        },

        confirmDeleteCategory() {
            this.showConfirmDeleteCategory = false;
            this.deleteCategories();
        },

        async deleteCategories() {
            if (this.selectedCategories.length === 0) {
                return;
            }

            this.deletingCategories = true;

            try {
                const formData = new FormData();

                this.selectedCategories.forEach(id => {
                    formData.append('categories[]', id);
                });

                formData.append(
                    '_token',
                    window.kategoriProdukRoutes.csrf
                );

                formData.append('_method', 'DELETE');

                const response = await fetch(
                    window.kategoriProdukRoutes.destroy,
                    {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    }
                );

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Gagal menghapus kategori.'
                    );
                }

                this.categories = this.categories.filter(
                    kategori =>
                        !data.deleted_ids.includes(kategori.id)
                );

                this.selectedCategories = [];

                this.showSuccess(data.message);

            } catch (error) {
                console.error(error);
                this.showError(error.message);

            } finally {
                this.deletingCategories = false;
            }
        },

        showSuccess(message) {
            this.successMessage = message;
            this.showSuccessModal = true;
        },

        showError(message) {
            this.errorMessage = message;
            this.showErrorModal = true;
        },

        closeSuccess() {
            this.showSuccessModal = false;
        },

        closeError() {
            this.showErrorModal = false;
        }
    };
}