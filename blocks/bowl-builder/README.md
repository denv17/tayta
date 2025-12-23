# Bowl Builder Block

Interactive bowl customization block with radio button options.

## Fields

- **Title** (text, required): Main heading
- **Subtitle** (text): Subtitle text below title
- **Base Price** (number): Starting price for the bowl (default: \$10.00)
- **Option Groups** (repeater): Groups of customizable options (order determines step number)
  - **Group Title** (text, required): Name of the group (e.g., "Choose your base")
  - **Options** (repeater): Individual options within the group
    - **Option Name** (text, required): Name of the option (e.g., "White Rice")
    - **Additional Price** (text): Just enter the number (e.g., "1", "2", "4"). Will display as "+$1", "+$2", etc.
- **Bowl Preview Image** (image): Image shown in the summary card

## Color Pattern (Alternating)

Colors alternate automatically based on group order:

- **Odd groups (1, 3, 5, 7...)**: Yellow (#FFBE00)
- **Even groups (2, 4, 6, 8...)**: Orange (#FF4B00)

## Example Option Groups

### Group 1 - Choose your base (Yellow)

- White Rice (no extra cost)
- Tacu Tacu (additional price: `1`) → displays as "+\$1"
- Arroz Chaufa (additional price: `1`) → displays as "+\$1"
- Greens (no extra cost)

### Group 2 - Choose your Protein (Orange)

- Lomo Saltado (Beef Tenderloin)
- Pollo Saltado (Chicken Thigh)
- Vegeterian Stir-Fry

### Group 3 - Pick a Sauce (Yellow)

- Aji Verde
- Huancaina
- Salsa Criolla
- Smoky Rocoto

### Group 4 - Add Extras (Orange)

- Fried Egg (additional price: `2`) → displays as "+\$2"
- Extra Tacu Tacu Patty (additional price: `4`) → displays as "+\$4"
- Crispy Fries
- Sweet Plantains
- Fried Yuca

## Features

- ✅ Radio button selection (one per group)
- ✅ **Automatic color alternation**:
  - Odd groups (1, 3, 5...): Yellow (#FFBE00)
  - Even groups (2, 4, 6...): Orange (#FF4B00)
- ✅ **Automatic numbering** - Based on group order
- ✅ **Automatic price formatting** - Just enter numbers (1, 2, 4)
- ✅ **Live summary update** - Selected options appear in real-time
- ✅ **Automatic price calculation** - Total updates based on selections
- ✅ Configurable base price from ACF
- ✅ Smooth transitions and hover effects
- ✅ Responsive design
