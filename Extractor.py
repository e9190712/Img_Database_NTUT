import os
import sys
from PIL import Image
def main(gif_file):
    png_dir ='./' + gif_file.split("/")[1][:-4] + '/'
    os.mkdir(png_dir)
    img = Image.open(gif_file)
    try:
        while True:
            current = img.tell()
            img.save(png_dir+str(current)+'.png')
            img.seek(current+1)
            print(gif_file.split("/")[1][:-4])
    except:
        pass
gif_file = sys.argv[1:]
if len(gif_file) >= 2:
    gif_file = " ".join(gif_file)
else:
    gif_file = gif_file[0]
main(gif_file)