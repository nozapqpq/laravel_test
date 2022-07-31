from PIL import Image, ImageDraw
import numpy as np

def make_shironuri_image(target_axis, output_fn, binarization=False):
    im = Image.open("/var/www/laravel/download/yuma_temp.jpg")
    width, height = im.size
    draw = ImageDraw.Draw(im)
    draw.rectangle([(0,0),(target_axis,500)], fill=1, width=1)
    draw.rectangle([(180,0),(500,500)], fill=1, width=1)

    if binarization == True:
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
                if g(cal_img[i,c]) < 20:
                    img2.putpixel((c, i), (0, 0, 0))
                else:
                    img2.putpixel((c, i), (255, 255, 255))

        img2.save(output_fn)

    else:
        im.save(output_fn)

    print("finish")

# 1ピクセルの差や2値化の有無で解析に差が出るので全部見る
make_shironuri_image(92,'/var/www/laravel/download/yuma_temp_shironuri1.png',True)
make_shironuri_image(93,'/var/www/laravel/download/yuma_temp_shironuri2.png',True)
make_shironuri_image(92,'/var/www/laravel/download/yuma_temp_shironuri3.png',False)
make_shironuri_image(93,'/var/www/laravel/download/yuma_temp_shironuri4.png',False)
