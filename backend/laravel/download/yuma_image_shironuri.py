from PIL import Image, ImageDraw
import numpy as np
im = Image.open("/var/www/laravel/download/yuma_temp.jpg")
width, height = im.size
draw = ImageDraw.Draw(im)
draw.rectangle([(0,0),(93,500)], fill=1, width=1)
draw.rectangle([(180,0),(500,500)], fill=1, width=1)

img2 = Image.new("RGB", (width, height))
cal_img = np.zeros(shape=((height,width)), dtype="object")

for i in range(height):
    for c in range(width):
        cal_img[i,c] = im.getpixel((c,i))

for i in range(height):
    for c in range(width):
        #gray scaleに変換
        g = lambda x : np.mean(x)
        
        #閾値を設定し白黒に
        if g(cal_img[i,c]) < 130:
            img2.putpixel((c, i), (0, 0, 0))
        else:
            img2.putpixel((c, i), (255, 255, 255))

img2.save('/var/www/laravel/download/yuma_temp_shironuri.png')
print("finish")
