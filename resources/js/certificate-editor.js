import interact from 'interactjs';

function makeDraggable(id) {

    interact(id).draggable({

        listeners: {

            move(event) {

                const target = event.target;

                const x =
                    (parseFloat(target.getAttribute('data-x')) || 0)
                    + event.dx;

                const y =
                    (parseFloat(target.getAttribute('data-y')) || 0)
                    + event.dy;

                target.style.transform =
                    `translate(${x}px, ${y}px)`;

                target.setAttribute('data-x', x);
                target.setAttribute('data-y', y);

            }
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {

    const templateInput =
        document.querySelector('input[name="template"]');

    if (templateInput) {

        templateInput.addEventListener('change', function (e) {

            const file = e.target.files[0];

            if (!file) return;

            document.getElementById('template-preview')
                .src = URL.createObjectURL(file);
        });
    }

    makeDraggable('#drag-name');
    makeDraggable('#drag-category');
    makeDraggable('#drag-number');

    const nameColor = document.getElementById('name_color');
    const nameSize = document.getElementById('name_size');

    if (nameColor) {

        nameColor.addEventListener('input', () => {

            document.getElementById('drag-name')
                .style.color = nameColor.value;

        });

    }

    if (nameSize) {

        nameSize.addEventListener('input', () => {

            document.getElementById('drag-name')
                .style.fontSize =
                nameSize.value + 'px';

        });

    }

    document.getElementById('category_color')
    ?.addEventListener('input', (e) => {

        document.getElementById('drag-category')
            .style.color = e.target.value;

    });

    document.getElementById('category_size')
    ?.addEventListener('input', (e) => {

        document.getElementById('drag-category')
            .style.fontSize =
            e.target.value + 'px';

    });

    document.getElementById('number_color')
    ?.addEventListener('input', (e) => {

        document.getElementById('drag-number')
            .style.color = e.target.value;

    });

    document.getElementById('number_size')
    ?.addEventListener('input', (e) => {

        document.getElementById('drag-number')
            .style.fontSize =
            e.target.value + 'px';

    });

    const form = document.querySelector('form');

    if (form) {

        function getScaledPosition(element, image, center = false) {
            const imageRect = image.getBoundingClientRect();
            const elementRect = element.getBoundingClientRect();
            const displayWidth = imageRect.width || image.naturalWidth;
            const displayHeight = imageRect.height || image.naturalHeight;
            const pdfWidth = 1123;
            const pdfHeight = 794;
            const scaleX = displayWidth ? pdfWidth / displayWidth : 1;
            const scaleY = displayHeight ? pdfHeight / displayHeight : 1;

            return {
                left: ((elementRect.left - imageRect.left) + (center ? (elementRect.width / 2) : 0)) * scaleX,
                top: (elementRect.top - imageRect.top) * scaleY,
            };
        }

        form.addEventListener('submit', () => {
            const name = document.getElementById('drag-name');
            const category = document.getElementById('drag-category');
            const number = document.getElementById('drag-number');
            const templateImg = document.getElementById('template-preview');

            const namePos = getScaledPosition(name, templateImg);
            const categoryPos = getScaledPosition(category, templateImg, true);
            const numberPos = getScaledPosition(number, templateImg, true);

            document.querySelector('[name=name_x]').value = Math.round(namePos.left);
            document.querySelector('[name=name_y]').value = Math.round(namePos.top);

            document.querySelector('[name=category_x]').value = Math.round(categoryPos.left);
            document.querySelector('[name=category_y]').value = Math.round(categoryPos.top);

            document.querySelector('[name=number_x]').value = Math.round(numberPos.left);
            document.querySelector('[name=number_y]').value = Math.round(numberPos.top);

            document.querySelector('[name=name_color]').value =
                document.getElementById('name_color').value;
            document.querySelector('[name=name_size]').value =
                document.getElementById('name_size').value;
            document.querySelector('[name=category_color]').value =
                document.getElementById('category_color').value;
            document.querySelector('[name=category_size]').value =
                document.getElementById('category_size').value;
            document.querySelector('[name=number_color]').value =
                document.getElementById('number_color').value;
            document.querySelector('[name=number_size]').value =
                document.getElementById('number_size').value;

            document.querySelector('[name=name_left]').value = Math.round(namePos.left);
            document.querySelector('[name=name_top]').value = Math.round(namePos.top);
            document.querySelector('[name=category_left]').value = Math.round(categoryPos.left);
            document.querySelector('[name=category_top]').value = Math.round(categoryPos.top);
            document.querySelector('[name=number_left]').value = Math.round(numberPos.left);
            document.querySelector('[name=number_top]').value = Math.round(numberPos.top);
        });
    }

});
