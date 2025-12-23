/**
 * Bowl Builder
 * Interactive bowl customization with dynamic styling and summary
 */

export const initBowlBuilder = () => {
  const options = document.querySelectorAll("[data-bowl-option]");
  const summaryElement = document.querySelector("[data-bowl-summary]");
  const totalElement = document.querySelector("[data-bowl-total]");

  if (options.length === 0) return;

  const variantStyles = {
    yellow: {
      bg: "bg-yellow",
      text: "text-blue",
    },
    orange: {
      bg: "bg-orange",
      text: "text-blue",
    },
  };

  const basePrice = parseFloat(
    summaryElement?.getAttribute("data-base-price") || "10"
  );

  const updateSummary = () => {
    const selectedRadios = document.querySelectorAll(
      '[data-bowl-option] input[type="radio"]:checked'
    );

    let total = basePrice;

    selectedRadios.forEach(radio => {
      const groupIndex = radio.getAttribute("data-group");
      const optionName = radio.value;
      const additionalPrice = parseFloat(radio.getAttribute("data-price")) || 0;

      // Update summary text
      const summaryElement = document.querySelector(
        `[data-summary-group="${groupIndex}"]`
      );
      if (summaryElement) {
        summaryElement.textContent = optionName;
      }

      // Add to total
      total += additionalPrice;
    });

    // Update total price
    if (totalElement) {
      totalElement.textContent = `$${total.toFixed(2)}`;
    }
  };

  options.forEach(option => {
    const radio = option.querySelector('input[type="radio"]');
    const variant = option.getAttribute("data-bowl-option");

    if (!radio) return;

    radio.addEventListener("change", () => {
      // Remove styles from all options in the same group
      const groupName = radio.getAttribute("name");
      const groupOptions = document.querySelectorAll(
        `[data-bowl-option] input[name="${groupName}"]`
      );

      groupOptions.forEach(otherRadio => {
        const otherLabel = otherRadio.closest("[data-bowl-option]");
        if (otherLabel) {
          // Reset to default white background
          otherLabel.classList.remove("bg-yellow", "bg-orange", "text-blue");
          otherLabel.classList.add("bg-white");

          // Reset text color
          const labelText = otherLabel.querySelector("span:last-child");
          if (labelText) {
            labelText.classList.add("text-blue");
          }
        }
      });

      // Apply variant styles to selected option
      if (radio.checked) {
        const styles = variantStyles[variant] || variantStyles.orange;

        option.classList.remove("bg-white");
        option.classList.add(styles.bg);

        const labelText = option.querySelector("span:last-child");
        if (labelText) {
          labelText.classList.remove("text-blue");
          labelText.classList.add(styles.text);
        }
      }

      // Update summary
      updateSummary();
    });
  });

  // Initialize summary
  updateSummary();
};
