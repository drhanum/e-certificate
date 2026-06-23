import argparse
import sys
from pathlib import Path

import pypdfium2 as pdfium
from PIL import Image


def convert(pdf_path: Path, output_path: Path, fmt: str, scale: float = 4.0) -> None:
    document = pdfium.PdfDocument(str(pdf_path))

    try:
        if len(document) == 0:
            raise ValueError("PDF tidak memiliki halaman.")

        page = document[0]
        bitmap = page.render(scale=scale)
        image = bitmap.to_pil()

        if fmt in {"jpg", "jpeg"}:
            if image.mode in {"RGBA", "LA"}:
                background = Image.new("RGB", image.size, (255, 255, 255))
                alpha = image.getchannel("A") if "A" in image.getbands() else None
                background.paste(image, mask=alpha)
                image = background
            elif image.mode != "RGB":
                image = image.convert("RGB")
        elif image.mode not in {"RGB", "RGBA"}:
            image = image.convert("RGBA" if "A" in image.getbands() else "RGB")

        output_path.parent.mkdir(parents=True, exist_ok=True)

        if fmt in {"jpg", "jpeg"}:
            image.save(output_path, format="JPEG", quality=95, optimize=True)
        else:
            image.save(output_path, format="PNG", optimize=True)
    finally:
        document.close()


def main() -> int:
    parser = argparse.ArgumentParser(description="Convert PDF to PNG/JPG")
    parser.add_argument("pdf_path")
    parser.add_argument("output_path")
    parser.add_argument("format", choices=["png", "jpg", "jpeg"])
    parser.add_argument("--scale", type=float, default=4.0)
    args = parser.parse_args()

    try:
        convert(Path(args.pdf_path), Path(args.output_path), args.format.lower(), args.scale)
    except Exception as exc:
        print(str(exc), file=sys.stderr)
        return 1

    return 0


if __name__ == "__main__":
    raise SystemExit(main())
