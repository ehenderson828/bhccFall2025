// toggleInfo function 
const toggleInfo = () => {
    // Loop over each h2 and add event listeners
    $("h2").each(function(index) {
        // Reference to the h2 being iterated over
        const $h2 = $(this);
        $h2.on({
            // Show sibling paragraph on mouseenter
            mouseenter: () => {
                $h2.next("p").show(500);
            },
            // Hide sibling paragraph on mouseleave
            mouseleave: () => {
                $h2.next("p").hide(500);
            }
        });
    });
};

// Once document has loaded, call toggleInfo()
$(document).ready(() => {
    toggleInfo();
});
