// Additional JavaScript functions can be added here

// Auto-calculate age from year
function calculateCarAge(year) {
    const currentYear = new Date().getFullYear();
    return currentYear - year;
}

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

// Debounce function for search
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Export functions for global use
window.RentalApp = {
    formatCurrency,
    calculateCarAge,
    debounce
};