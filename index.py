import sys
import json
import pydicom as dicom
import imageio
import scipy.misc
params = sys.argv[1:] #即為獲取到的PHP傳入python的入口引數
if len(params) >= 2:
    params = " ".join(params)
else:
    params = params[0]
name = 'images/%s.gif'%(params.split("/")[1].split(".")[0])
imgs = dicom.read_file(params).pixel_array
if len(imgs.shape) == 2:
    name = 'images/%s.jpg'%(params.split("/")[1].split(".")[0])
    scipy.misc.imsave(name, imgs)
else:
    imageio.mimsave(name, imgs,duration=0.001)

print(name)