<?php

namespace App\Dto;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints\NotBlank;

#[OA\Schema(
    schema: "FileDto",
    required: ["name", "base64"],
    properties: [
        new OA\Property(property: "name", description: "Название файла", type: "string", example: "document.pdf"),
        new OA\Property(property: "base64", description: "Файл в формате base64", type: "string", format: "byte", example: "data:application/pdf;JVBERi0xLjcNCiW1tbW1DQoxIDAgb2JqDQo8PC9UeXBlL0NhdGFsb2cvUGFnZXMgMiAwIFIvTGFuZyhydS1SVSkgL1N0cnVjdFRyZWVSb290IDE1IDAgUi9NYXJrSW5mbzw8L01hcmtlZCB0cnVlPj4vTWV0YWRhdGEgMjcgMCBSL1ZpZXdlclByZWZlcmVuY2VzIDI4IDAgUj4+DQplbmRvYmoNCjIgMCBvYmoNCjw8L1R5cGUvUGFnZXMvQ291bnQgMS9LaWRzWyAzIDAgUl0gPj4NCmVuZG9iag0KMyAwIG9iag0KPDwvVHlwZS9QYWdlL1BhcmVudCAyIDAgUi9SZXNvdXJjZXM8PC9Gb250PDwvRjEgNSAwIFIvRjIgMTIgMCBSPj4vRXh0R1N0YXRlPDwvR1MxMCAxMCAwIFIvR1MxMSAxMSAwIFI+Pi9Qcm9jU2V0Wy9QREYvVGV4dC9JbWFnZUIvSW1hZ2VDL0ltYWdlSV0gPj4vTWVkaWFCb3hbIDAgMCA1OTUuMzIgODQxLjkyXSAvQ29udGVudHMgNCAwIFIvR3JvdXA8PC9UeXBlL0dyb3VwL1MvVHJhbnNwYXJlbmN5L0NTL0RldmljZVJHQj4+L1RhYnMvUy9TdHJ1Y3RQYXJlbnRzIDA+Pg0KZW5kb2JqDQo0IDAgb2JqDQo8PC9GaWx0ZXIvRmxhdGVEZWNvZGUvTGVuZ3RoIDE3MT4+DQpzdHJlYW0NCniclY4xC8JADIX3wP2HN6rgNble6RXKDb3WoiAoFhzEUTspqP8fvFoHBRcDgbzkkfch2aAsk3VY1mDvUdUBN0WseSjncgEjKzKdGjgrujC4nxTtZ7gqqjpFyUIgotmiOysa3AyBy7TEVZ5b7eLlEn3tThj9I/5GP0p5y1bRoeQ0zWKLn9s4S/BHdCtFTYzYKvoTyfxAEmbtzCfSC2SMn2D6lYdmHfAE0XQ2SA0KZW5kc3RyZWFtDQplbmRvYmoNCjUgMCBvYmoNCjw8L1R5cGUvRm9udC9TdWJ0eXBlL1R5cGUwL0Jhc2VGb250L0JDREVFRStDYWxpYnJpL0VuY29kaW5nL0lkZW50aXR5LUgvRGVzY2VuZGFudEZvbnRzIDYgMCBSL1RvVW5pY29kZSAyMyAwIFI+Pg0KZW5kb2JqDQo2IDAgb2JqDQpbIDcgMCBSXSANCmVuZG9iag0KNyAwIG9iag0KPDwvQmFzZUZvbnQvQkNERUVFK0NhbGlicmkvU3VidHlwZS9DSURGb250VHlwZTIvVHlwZS9Gb250L0NJRFRvR0lETWFwL0lkZW50aXR5L0RXIDEwMDAvQ0lEU3lzdGVtSW5mbyA4IDAgUi9Gb250RGVzY3JpcHRvciA5IDAgUi9XIDI1IDAgUj4+DQplbmRvYmoNCjggMCBvYmoNCjw8L09yZGVyaW5nKElkZW50aXR5KSAvUmVnaXN0cnkoQWRvYmUpIC9TdXBwbGVtZW50IDA+Pg0KZW5kb2JqDQo5IDAgb2JqDQo8PC9UeXBlL0ZvbnREZXNjcmlwdG9yL0ZvbnROYW1lL0JDREVFRStDYWxpYnJpL0ZsYWdzIDMyL0l0YWxpY0FuZ2xlIDAvQXNjZW50IDc1MC9EZXNjZW50IC0yNTAvQ2FwSGVpZ2h0IDc1MC9BdmdXaWR0aCA1MjEvTWF4V2lkdGggMTc0My9Gb250V2VpZ2h0IDQwMC9YSGVpZ2h0IDI1MC9TdGVtViA1Mi9Gb250QkJveFsgLTUwMyAtMjUwIDEyNDAgNzUwXSAvRm9udEZpbGUyIDI0IDAgUj4+DQplbmRvYmoNCjEwIDAgb2JqDQo8PC9UeXBlL0V4dEdTdGF0ZS9CTS9Ob3JtYWwvY2EgMT4+DQplbmRvYmoNCjExIDAgb2JqDQo8PC9UeXBlL0V4dEdTdGF0ZS9CTS9Ob3JtYWwvQ0EgMT4+DQplbmRvYmoNCjEyIDAgb2JqDQo8PC9UeXBlL0ZvbnQvU3VidHlwZS9UcnVlVHlwZS9OYW1lL0YyL0Jhc2VGb250L0JDREZFRStDYWxpYnJpL0VuY29kaW5nL1dpbkFuc2lFbmNvZGluZy9Gb250RGVzY3JpcHRvciAxMyAwIFIvRmlyc3RDaGFyIDMyL0xhc3RDaGFyIDMyL1dpZHRocyAyNiAwIFI+Pg0KZW5kb2JqDQoxMyAwIG9iag0KPDwvVHlwZS9Gb250RGVzY3JpcHRvci9Gb250TmFtZS9CQ0RGRUUrQ2FsaWJyaS9GbGFncyAzMi9JdGFsaWNBbmdsZSAwL0FzY2VudCA3NTAvRGVzY2VudCAtMjUwL0NhcEhlaWdodCA3NTAvQXZnV2lkdGggNTIxL01heFdpZHRoIDE3NDMvRm9udFdlaWdodCA0MDAvWEhlaWdodCAyNTAvU3RlbVYgNTIvRm9udEJCb3hbIC01MDMgLTI1MCAxMjQwIDc1MF0gL0ZvbnRGaWxlMiAyNCAwIFI+Pg0KZW5kb2JqDQoxNCAwIG9iag0KPDwvQXV0aG9yKP7/BBgEOwRMBE8AIAQvBEcEPAQ1BD0ENQQyKSAvQ3JlYXRvcij+/wBNAGkAYwByAG8AcwBvAGYAdACuACAAVwBvAHIAZAAgAEwAVABTAEMpIC9DcmVhdGlvbkRhdGUoRDoyMDI1MDIyMDE1NTMyNyswMycwMCcpIC9Nb2REYXRlKEQ6MjAyNTAyMjAxNTUzMjcrMDMnMDAnKSAvUHJvZHVjZXIo/v8ATQBpAGMAcgBvAHMAbwBmAHQArgAgAFcAbwByAGQAIABMAFQAUwBDKSA+Pg0KZW5kb2JqDQoyMiAwIG9iag0KPDwvVHlwZS9PYmpTdG0vTiA3L0ZpcnN0IDQ2L0ZpbHRlci9GbGF0ZURlY29kZS9MZW5ndGggMjk5Pj4NCnN0cmVhbQ0KeJxtUdFqgzAUfS/0H+4fXGN13aAUxtqyUSqiwh5KH1K9U6kmJUZo/365060+7CGXe27OOTlJfA88EC8QChAhCM+tJ4fdWkKw8EE8QxCG4AsIlh6sVhgz24MEU4wxu18JU2v63G4banF/BO8EGJewYM56PZ8NknCUbHTet6Tsf0qfoyQnGFUTRmaIEq0tJrqhg7xyRvaLpXFevMtxeeJshnic4m83opvd0x3EaL1zXkpbwojLVhUPkDnqWd8wpdziO8mCzNCz5rf/UE2tKK0kJ+TBq3IO0tZajdjY+ku65gd9anM5a3153J4nXUVkOaTFg8yNnuC3ytUJ3tSy0eVkkDZ1QRPucI6jlUa2uKvL3tB416hvO/cr/IPT141kS91xgI+nn8++AZQBotkNCmVuZHN0cmVhbQ0KZW5kb2JqDQoyMyAwIG9iag0KPDwvRmlsdGVyL0ZsYXRlRGVjb2RlL0xlbmd0aCAyMzk+Pg0Kc3RyZWFtDQp4nF2QwWrEIBCG7z7FHHcPi0ndPRSCUFIKOWxbmvYBjE5SoVEx5pC372iWLXRA4WPm//lneNs9d84m4O/R6x4TjNaZiItfo0YYcLKO1RUYq9ONyq9nFRgncb8tCefOjZ41DfAPai4pbnB4Mn7AI+Nv0WC0boLDV9sT92sIPzijS1AxKcHgSEZXFV7VjMCL7NQZ6tu0nUjzN/G5BYSHwvUeRnuDS1Aao3ITsqaiktC8UEmGzvzri101jPpbRZoWdUvT1Vk8ykyiLnQWO112uhSnmyZ75tXvgfUaI2Ut9ykhczzr8H7C4ENW5fcLNvF0oQ0KZW5kc3RyZWFtDQplbmRvYmoNCjI0IDAgb2JqDQo8PC9GaWx0ZXIvRmxhdGVEZWNvZGUvTGVuZ3RoIDIxMzcxL0xlbmd0aDEgODYyMDA+Pg0Kc3RyZWFtDQp4nOx9B3yUVbr+Od83vWRmkkwyyZDMJJOEMkACoSSAZCAFQugwmFATkkDQUKQIKGAUBY1gbygqVtzFMhlQgl3XVdfe61pYy+oqtrWBkNznfO+cGPjr/u+ue9e7e+dNnnme857yne89NT+DYZwx5sSHjtWWjy6bXtU4NYPxvr0YU1aWjx5fesdd479gvPfjSNdOmpY/8OqH6u9kjJ+NWrX1i+uWXZ8cHM5Ycxlj6pL6k1f69y17bTBj1/2RMf29C5YtXLzhbXUoY0v3MGYPLmxeu+CCusdXMLbzCsbSL2pqrGvoOHzby2jPhvaGNMFhv63HAaTRHstpWrxyzZpHrfuQ/oixE2Y3L62v+55/+SxjD/dlbKhhcd2aZf2X5TmR34Ty/sWNK+uuPGPHyYz33470mUvqFje6E85bxdjBQYwVrFy2dMXKTi/bhPe5RZRftrxx2U0/LLqfsXXv4nEHmYiFYfT57wzeUjnPMeIblmZiwu75ZN1Tgt/6/oZHfzh0pMX8qWkIkmamMDLUM7AOxh+x7Pjh0KEd5k+1lrpZ2q3C4z2DtTAna2QqajpZPtvMWOIoPFdBrqoL8guYnpn02/SFaDKTWH2ObVKYiSkOvaIoOlXRvc/6dz7Mck7VegCbMM3vZyHGcp+iPhivUfL8jHeKPHWvPkG8KUvWJfzYG/4s+z9vhlfZrb92H/5TTNfIrvu1+/D3mMHwP9Nf9cCvFwf1KTZE3Yhd5Vc23SBW+2v3IW6/3JQn2LZfuw//ClNXs97qtSz7H62vfMDG/iP1+Les+Sfb28B6KZuY7x/tT9ziFrf//aY7h10HXPZL21GvZplHpXEP+KVt/lLTTWPbgDX/7HaP3afF3v2L2ltC6G7KVdzyc+WVWnbglzzvP9XUwezcX7sPcYtb3OIWt3/cdA+xBf/yZy5m5/2rnxm3uMUtbnGLW9ziFre4xS1ucfvPtfjPmXGLW9ziFre4xS1ucYtb3OIWt7jFLW7/u43/n/ht9LjFLW5xi1vc4ha3uMUtbnGLW9ziFre4xS1ucYtb3OIWt7jFLW5xi1vc4ha3uMUtbnGLW9ziFre4xS1ucYtb3OIWt38H67z71+5B3OIWt7/LdIAK5MT+8lUUKa6lVWZhTLkGJcT/fyeTOeERf4vKzrLZBNbAlrO1bIeuWFeqK88o9ptzn+rU/nIV8v2x/DXILzoqn3d+g33iO3YXT+cTO+s73uv4rOOLTzYf6PnOcbHnp/9sT1V1nHo5M/BPtdSXx/6lLqSV2N/1UtjfNt6tvf8JK/t7CvOff2PGt3TTj/LH/tEO/ctM/ae2ZtM+n4ulnN1yxAjaYxCj7Y9BPD+LoI4DZxO0cZ4QgxidBoIW++UELdbiLx+sFbEG74gBbeqKgGJIL7iUoA4AlxPUwYxlFBNMD6IrZoK9QPx1N4Ie6dDMTWetXLH8pGVLlyxuPvGERU0LFzQ2zJ83d87sWTNrqsPTp02dMnnSxAnjq8ZVjh1TUV5WOnpUqGTkcSOGDysuGjpkcH7/fn175eXmBLJ9nmSX02G3Wswmo0GvUxXO+pYHKmr9kbzaiC4vMHZsP5EO1MFR181RG/HDVXF0mYi/VivmP7pkCCUXHFMyRCVDXSW50z+CjejX118e8EeeLgv42/nMKdXQW8sCNf7IAU1P0LQuT0vYkcjKQg1/uaepzB/htf7ySMXJTa3ltWVor81qKQ2UNlr69WVtFiukFSrSK7CsjfcayTWh9Cof1qYwk108NqLmltc1RCZPqS4v82Zl1Wg+Vqq1FTGURoxaW/5Fos/sXH9b3wdbt7Q72fzaoK0h0FA3uzqi1qFSq1re2ro54gpGegfKIr1Ped+DV26M9A2UlUeCATRWNbXrATyiz3UG/K3fMHQ+cODToz11MY8h1/kNE1K8YleYkC81Q9/QQ7xfVpboy7ntITYfiUjLlGpK+9l8b5SF8oM1EaVW5Dwoc9xhkdMic7qq1wayxFCV18a+T27yRFrm+/v1RfS171x8I98fUfNq59c3Ca5rbA2UlVHcpldHQmUQobrYu5a3FeSjfF0tXmKRCMOU6kh+YFkkOTCaCsDhF2OwaFq1ViVWLZJcGmG19bFakfzyMtEvf3lrbRl1ULQVmFK9jxV2vts2yO/dXcgGsRrRj0hKKQYlr7y1umFBxFfrbcD8XOCv9mZFQjUIX02gurFGjFLAGen9Lh6XpT1Rq4V3O6a0LCze3Jhr8lcrXrVGjBYc/gp8BEaPQIYTw6UlxYiOHuGv5l4mi+EpsRJCHdUOEmpu6ViRpYqqpWO9WTVZZH+jS95Yn/S5EVO3tpxwdPWJnvOzXaPSokO9/eWNZd06eFSj+lgHY639dD8VEYvYg1HDJIZzrMxSc7Fy4VPQjOYSo+jxR9hkf3WgMVATwBwKTa4W7yZirY1v1bRA1ZSZ1dpox2bJ9KNSlF9EqQjLQrZMKKWYgxVBrxxWLT1GS3clxx6TXSmzA6Jfra0NbUzNFVPZ28Y1oS89tyYyKVgTiMwPBrJEP/v1bTMxW9b02lKs1Qpsd4GKuoDf6a9orWvvbJnf2hYKtS4rr20ahnXRGqhsaA1Mqx7h1To/tXq99xTx7ERWxaumj0ZTChvdFuBnT2kL8bOnzazeh6PKf/b06qjCldLa0TVtOcir3ocDKqR5FeEVTpHwi4RoaSoSJq28d1+IsRYtV6c5tHR9O2eazyR9nNW3K+Rz0oPytAeFcCbWt+soJyRL6+Azka+FSveKlTYhxyly7mY4SJiWSdbGRIBDFn3IFDKHbIpdQUiFKwrP3Shr5my3jdu5tw1tTtXc7bylzRzy7tNamhor2YKSwtfS5UPPRbFuDeF59OLhH98gPLN6t42hfe0TJUYLwyz0NGEO4Twp9zeI+beupqm1tkbsHiwFcxXfPMIDI1lECYxEjw22iCXQODpiDYwW/hLhLyG/QfiNmPk8hWOwxabbWhvARowVU828nNaaKpr0t3d2Tq/Oetp7oCYLa2k2MLM6Yg7icNPnjkO5MQK1cI+JtNTXiX6wcLWoa8ytrK/BupQNokhlxIwWzLEWUKJCqyPWGyrVY67VBTQJN7aOlppITVA8tHpRjbZenRE2NjAsYsijNvV54kH5Na2JgYHa5oO1bsndLMiMvrFp1eTxIomH1VCQjDb0vD6ArPpaP82RaVjLdFhYvORpxJ6vy2vUYPHGMpl4LTXXardEzP3RIL6FtvYXe44+11hTQ53XUptjBfBsZ8SKHuV1C2WsAqKDrErRF3xvRldF0YdEM1Pa2dTAGmydotNaS0ZkR+y5lXU43ai+FZ5AkaxsEpugNdbGI+Q1ije3Ie7YEto7dwbWZnUz7B3i9BPzj3n3YaGymtZjHZFZwX59Tcd67Zq7tdVk/+kKFC+TvYs1p5JbL04FsJhw2nzzl4ujMjCuTZkY1Jhr3DougBNEyRXARUfF8snyN9SIUujyZG0v+9lCvFshcUxrjbc6h8sUj6VoMFsjC49ONnUlKwRwGcztT3cIvIrYazFXTvBGmjEzZRExIv5WvzMwLCA+tMpjBGoxSF3LAtMfs04smpZ6f/V8THY0WFHbWtEqrqj1dbGwxZ4UWRI8qkmsC47Jg4bE60RaJvtra/y1uJryKdVZWV6sRrB/Ae6pgTpxFEym95k8U7uq1LWKKc5wU6nxRow4mBbUNQaycIJExA5E0Rd91MWWDfO2tgZaI9q6rUBhNJ+HZVcpCN/LgoG6RnGFXiBu0I1a3Qp0V4uOaM1bHsBaboRbiyUCh61vvviobxUX9Dm1QUTC1ZrY6i9uxRY8B6eHLq9+Ri2OKnEi+bWhrvMihSBUilQNGqKC5lxRkJaA6M3iYNscY+6PHu17aZAKm7RW0bOp1ZHJsoi2noQ4KRhRUouQKV6eT51ZLfcpVWRXIrwhzCqvqO2PKNOrY8Oj1a8UVb1ywKgaPNoZEltfXaeNPIdmexHTn/XjcFBHTVMeVx5lRcynPBbjt1iR8gYLK6+DXwW/FuNXwC+DXwK/CH4B/Dz4AfD94PvA97Iw0ylvskHAdEDtUg3AjcBLgJ6diJY4s6I+Z8nKw6wMaABWApcAepS9H3k3okXO/MqZe8wePg4DulGKM6Q4XYoWKU6TYoMU66VYJ8WpUpwixVop1kixWoqTpVglxUopVkhxkhTLpFgqxRIpFkvRLMWJUpwgxSIpmqRYKMUCKRqlaJCiXor5UtRJUSvFPCnmSjFHitlSzJJiphQ1UlRLcbwUM6QISzFdimlSTJViihSTpZgkxUQpJkgxXooqKcZJUSnFWCnGSFEhRbkUZVKUSjFailFShKQokWKkFMdJMUKK4VIMk6JYiiIphkoxRIrBUgySolCKgVIMkKJAinwp+kvRT4q+UgSl6CNFbyl6SdFTijwpcqXIkSIgRbYUWVL4pfBJkSlFhhQ9pPBKkS5FmhQeKVKlSJHCLUWyFElSJErhksIphUOKBCnsUtiksEphkcIshUkKoxQGKfRS6KRQpVCk4FKwmOCdUnRIcUSKw1L8IMUhKQ5K8b0U30nxrRTfSPG1FH+V4ispvpTiCyk+l+IzKQ5I8akUn0jxFyk+luIjKf4sxYdSfCDF+1K8J8WfpNgvxbtSvCPF21K8JcUfpXhTijekeF2K16R4VYpXpHhZipekeFGKF6R4XornpHhWimekeFqKp6R4UoonpPiDFI9L8ZgUj0rxeykekeJ3UjwsxUNSPCjFA1LcL8V9UtwrxT1S3C3FPinapdgrxV1S3CnFHil2SxGVok2KiBR3SHG7FLdJcasUu6T4rRS/keIWKXZKcbMUN0lxoxQ3SHG9FNdJsUOKa6W4RoqrpdguxVVSXCnFNimukOJyKS6T4lIpLpHiYikukuJCKS6Q4nwpzpNiqxRbpDhXilYpzpHibCk2S7FJirOkkNceLq89XF57uLz2cHnt4fLaw+W1h8trD5fXHi6vPVxee7i89nB57eHy2sPltYfLaw+X1x4urz18uRTy/sPl/YfL+w+X9x8u7z9c3n+4vP9wef/h8v7D5f2Hy/sPl/cfLu8/XN5/uLz/cHn/4fL+w+X9h8v7D5f3Hy7vP1zef7i8/3B5/+Hy/sPl/YfL+w+X9x8u7z9c3n+4vP9wef/h8trD5bWHy2sPl7cdLm87XN52uLztcHnb4fK2w+Vth8vbDpe3HV66W4h25cxo5kgf7szRTDfoDEqdHs0cBmqh1GlEG6KZNtB6Sq0jOpXoFKK10YxRoDXRjFLQaqKTiVZR3kpKrSBaTs6TohmjQcuIlhItoSKLiZqJToz2KAedQLSIqIloIdGCaI8yUCOlGojqieYT1RHVEs0jmkv15lBqNtEsoplENUTVRMcTzSAKE00nmkY0lWgK0WSiSUQTiSYQjSeqIhoX9VaCKonGRr3jQGOIKqLeKlB51DseVEZUSjSa8kZRvRBRCdUbSXQc0QgqOZxoGFUvJioiGko0hGgwNTaIqJBaGUg0gKiAGssn6k/1+hH1JQoS9SHqTdSLqCc1nUeUS23mEAWIsqnpLCI/1fMRZRJlEPUg8hKlR9MngtKIPNH0SaBUohRyuomSyZlElEjkojwnkYOcCUR2IhvlWYksRGbKMxEZiQzRtMkgfTRtCkhHpJJToRQnYhrxTqIOrQg/QqnDRD8QHaK8g5T6nug7om+Jvol6poO+jnqmgf5Kqa+IviT6gvI+p9RnRAeIPqW8T4j+Qs6PiT4i+jPRh1TkA0q9T6n3KPUnov1E71LeO0Rvk/Mtoj8SvUn0BhV5nVKvEb0aTT0e9Eo0dQboZaKXyPki0QtEzxM9R0WeJXqGnE8TPUX0JNETVOQPRI+T8zGiR4l+T/QI0e+o5MOUeojoQaIHKO9+ovvIeS/RPUR3E+0jaqeSeyl1F9GdRHuIdkdTSkDRaMosUBtRhOgOotuJbiO6lWgX0W+jKdiv+W+olVuIdlLezUQ3Ed1IdAPR9UTXEe0gupYau4ZauZpoO+VdRXQl0TaiK6jC5ZS6jOhSokso72Jq5SKiCynvAqLzic4j2kq0hUqeS6lWonOIzibaTLQp6q4DnRV1zwedSbQx6l4AOoPo9Kg7DGqJurEZ89Oi7iGgDUTrqfo6qncq0SlRdwNoLVVfQ7Sa6GSiVUQriVZQ08up+klEy6LuetBSamwJlVxM1Ex0ItEJRIuoXhPRQurZAqreSNRAJeuJ5hPVEdUSzSOaSy89h3o2m2gWvfRMarqGHlRNdDx1dwY9KEytTCeaRjSVaEo0OQSaHE0WT5gUTRbTe2I0eSNoQjS5H2g8FakiGhdNxr2AV1JqLNEYclZEkzeAyqPJm0Fl0eTTQKXR5BbQ6GhiBWgUUYiohGhkNBHnOz+OUiOirhrQcKJhUZeYGsVERVHXGNDQqKsaNCTqmgkaTHmDiAqjrr6ggVRyQNQlXqwg6hJrM5+oP1XvR0/oSxSkxvoQ9abGehH1JMojyo26RJRyiALUZja1mUWN+akVH1Em1csg6kHkJUonSos654A8UedcUGrUOQ+UQuQmSiZKIkqkCi6q4CSngyiByE5ko5JWKmkhp5nIRGQkMlBJPZXUkVMlUog4EQt1Oub7BDoc9b4jjgbfYegfgEPAQfi+h+874FvgG+Br+P8KfIW8L5H+Avgc+Aw4AP+nwCfI+wvSHwMfAX8GPkxY6Psgocn3PvAe8CdgP3zvgt8B3gbeQvqP4DeBN4DXgdfsJ/petQ/wvQJ+2d7se8me53sReAH6eXvQ9xzwLPAM8p+G7yn7Yt+T0E9A/wH6cfsJvsfsi3yP2pt8v7cv9D2Cur9Dew8DDwGhzgfx+QBwP3Cf7STfvbblvntsK3x321b69gHtwF747wLuRN4e5O2GLwq0ARHgDuta3+3WU3y3Wdf5brWu9+2ybvD9FvgNcAuwE7gZuMnaz3cj+AbgetS5DrzDeqLvWuhroK8GtkNfhbauRFvb0NYV8F0OXAZcClwCXAxchHoXor0LLBN951sm+c6zLPRttdzk22LZ6TtLzfWdqRb5NvIi3xnhlvDpu1rCp4XXhzfsWh+2rufW9d71VetPXb9r/ZvrQ4kGy7rwKeFTd50SXhteHV6za3X4bmUTW6CcFRoRPnnXqrBuVfKqlavUr1fxXat42SpesIorbJVzlX+ValsZXh5esWt5mC2fvLxleWS5bnhk+bvLFbacW9o7H9y93JtZAQ5tXm53VpwUXhpetmtpeMmCxeET0MFFRQvDTbsWhhcUNYQbdzWEHQ35DUp90fxwXVFteF7RnPDcXXPCs4tmhmftmhl2zMyfqdhqiqrDx6PqjKLp4fCu6eFpRVPCU3dNCU8qmhieCP+Eoqrw+F1V4XFFY8OVu8aGxxRVhMsRB9bD2cPfQ3WKvkzsgU4xLx9d4A153/V+4dUxb8T7oFdNdKT70pXejjReOimNL007Le38NNXhedajhDy9+1Y4Up9NfSf181RdUii1d/8KluJM8aeobvGaKROmV2hcUkY8YLD22r6UQF6Fw80dbp9bKf/czTcxlfs5Z9wJUk0os4e7fRXqfVz8pp+ecX4Bmx6sajexqVUR0+RZEX52JHea+AxNmRkxnB1h4Zmzqts4P69G+/WESLL4/RItfdbWrSxjdFUkY1p1VN2xI2N0TVWkRehQSNOdQjMUqQnOXbFqRbA6dBxzvev6wqW6H3A+61QcDu5wdDqUkAOddyT4EhTx0ZmghhIGDK1w2H12RXx02tWUkB0e8X49bZOnVzisPqsSLrFOsioha0lpRcjar6Di/3nP3eI96cnBlXPxMXfFyqD2jVQNXyWSQeEV3ytWIi2+VmlpFjzKRG1hK7q7VlGb81bAVkrnyuC/tfFfuwP//ka/1zOqUzmTNSgbgTOA04EW4DRgA7AeWAecCpwCrAXWAKuBk4FVwEpgBXASsAxYCiwBFgPNwInACcAioAlYCCwAGoEGoB6YD9QBtcA8YC4wB5gNzAJmAjVANXA8MAMIA9OBacBUYAowGZgETAQmAOOBKmAcUAmMBcYAFUA5UAaUAqOBUUAIKAFGAscBI4DhwDCgGCgChgJDgMHAIKAQGAgMAAqAfKA/0A/oCwSBPkBvoBfQE8gDcoEcIABkA1mAH/ABmUAG0APwAulAGuABUoEUwA0kA0lAIuACnIADSADsgA2wAhbADJgAI2AA9IBuVCc+VUABOMBYA4ePdwBHgMPAD8Ah4CDwPfAd8C3wDfA18FfgK+BL4Avgc+Az4ADwKfAJ8BfgY+Aj4M/Ah8AHwPvAe8CfgP3Au8A7wNvAW8AfgTeBN4DXgdeAV4FXgJeBl4AXgReA54HngGeBZ4CngaeAJ4EngD8AjwOPAY8CvwceAX4HPAw8BDwIPADcD9wH3AvcA9wN7APagb3AXcCdwB5gNxAF2oAIcAdwO3AbcCuwC/gt8BvgFmAncDNwE3AjcANwPXAdsAO4FrgGuBrYDlwFXAlsA64ALgcuAy4FLgEuBi4CLgQuAM4HzgO2AluAc4FW4BzgbGAzsAk4izWMauFY/xzrn2P9c6x/jvXPsf451j/H+udY/xzrn2P9c6x/jvXPsf451j/H+udY/xzrny8HsAdw7AEcewDHHsCxB3DsARx7AMcewLEHcOwBHHsAxx7AsQdw7AEcewDHHsCxB3DsARx7AMcewLEHcOwBHHsAxx7AsQdw7AEcewDHHsCxB3DsARx7AMcewLH+OdY/x/rnWPsca59j7XOsfY61z7H2OdY+x9rnWPsca//X3of/za3m1+7Av7mxFSu6XcyEeebN1f6Bi/EaxjouPupfw0xmJ7AVrAVfm9hWdjF7gL3J5rONUNvYDnYz+w2LsIfYH9ir/71/XPPfs461+sXMpu5lBpbEWOehzgMdNwPt+oRunouRStL5f/R0Ojs/O8b3WcfFnc6OdkMis2h17coL8P6VH+k8hEMX6c4hIq1shnZoNb40XtNxR8fOY2Iwhc1ks9hsNofVsjq8fwNrYosQmRNZM1vMlmipJchbiM8FSM1DKWwwmv6x1FK2DFjOVrJV7GR8LYNeEUuJvJO09Cq2Gl9r2Fp2CjuVrWPrY5+rNc865JyipdcAG9hpGJnT2RmakkyejexMdhZGbTM7m53zN1PndKlWdi7bgnE+j53/s3rrUakL8HUhuwjz4RJ2KbuMXYF5cRXbfoz3cs1/JbuGXYs5I/IuhedaTYnce9mj7E52O7uD3aXFsh5Ro4jIuCzQYrgMMViHN9zYrccUv9Vd0dqAdxfv1hp70zXwn9GtxsmxOIqSG1GSWqFxEK2sPyYSF+AdSP/4RpS6VHv/H73do/K3vDIe27tF5iotJdSx3p/Tl7GrsQKvw6eIqlDXQ5O6VtPd/dd0ld2hpW9gN7KbMBY7NSWZPDdD72S3YG3/lu1it+LrR91dEd/ObtNGLsLaWJTtZnswknexvaxd8/+tvJ/y7475o12efexudg9myP3sQew0D+NLeu6D74GY9xHNR+mH2e+QFqUo9Sh7DDvUE+xJ9hR7lv0eqWe0z8eReo69wF5kr3I71PPsY3weYc/p32cJbBRj+rsR5+1sLpv7z9zdjjV9OnOzHZ3fd67u/F4dyxbw6bhC3opR2sO24Mf2JT+W5D5m0f2JJbM9nd+qs8G9jryhb+q4vvNzpseuuUJ9AbucyoysmE1gE9nlkbOC1fcyO+4pKWwYv/NOd1mZqZ/xftxBFObHLcbEOC8NOXSKfW96eklg72DDVtVV2c777SkxbsX9vOTI20eeyT/y9oHE4vwDPP+t/W/vd375jKs4v3D/S/sHFHhDyen2vc2oOjiwt3mwatjarLpKRP2QubkkpBi3NqMRT0kw/ZngM/nBZ4JoJlgwoIa7slwakhMUozHZEMjurwzumTeksHDgSGXwoLxAdoKi+QYNGTpSLRyYqajJ0jNSEWmuvnB4pjrpiEHZECiZUajPTHck2w16pYcnsd+IXOe0Wbkj+mcYVaNB1ZuMvYaOzq5qLs9+w+jKcKdkJJpMiRkp7gyX8cib+oRDX+kTfijVNf9wiWoYPrskR73CYlJ0BkN7pietz/CsyhmOJKfOmuR0pZiMiS5br7LZRza5e4g2erjd1NaRCYyzWzsPGYKI/gj2ioh6yFk7ctlIxV5QkJqfb+nv8aS3d36028kngL/Y7YixXeNvd9s0/mi3VbDiCmXmDLDZLB4Utzgd4gMFLRaUsnhQxHI3fvBinQ+G0pBgOUOmWD2p9nzPgP4GX68pvnBiWB9mJbDE1GJXYQnPfym4XzvlB7oKnV3KVXxcfmGhq3BAwRwM40+24fmxEQxarhwCV4AnqEL15AFXl3OQGL1MJZUXcgyZkG5D0JTsS0vNSjIpHYWq1Z2R7M5MtiodY7gp2Z/m8ScZ+3qb/AU5HjNfreebrOm+vLTFDm+SLd1kM+r1RptJt/CHS4wWo6ozWgwYom1d/pv75NjSe3kPH6/enNknzWpOynBjSl/HmHoYp38i87GRNPeT8DM0Y+lKcshs9hxMaPAe1C9kJQdKMJtjU9iW4DnYnNCg9x5sRhYma4k2RcWLBbLztBfLwtsYB/WHwyVmqHq4svXxrT8k5+Qkc1frQxvLIr3Cm5svvGDBppq+im/LU5tGZWSpN2ZllJ/5wIapWxYOO/zZgMbLxb8evq7zkL4R/StiJ4je7enr7tfT0847Q+Zse76lX7/sQRaRcrHswQ39UqxqRl5DRpOzSd8kh1MM5v6BiRi6xOJi5/6BruJi8QqOY4vLkTt23AyG/++4pbj1jcYkf2qaP9GodJyrC/TCbDerHdsUY6I/Lc2XaMzzNPv6ZmHQeuv4QFtaVu8eC9JyUo1Wo06HD3X14TNtNtVgNqjrDp/T5X0s2y8G7Mgg5fHMPulWf7b4F9SIh7od8ShkIdYgIrKPWRT3ngHOoGuQ+JWNvOGudoyco0fQ9eHw4anF3/obUmPR0HakYgziwJf2IxavaEOZGBzu+rAZJf3F3zbHyopQaPtOcbdY9OzZXw0cHQQxxm6xH2WqqakpKWq34d5ucuf28Ga5LeoMR07BqEELtemblWzC+KfXnjWrIGPw+AHefrlZzhqL8VN3QVXo0vNGThyYlmREEFRzgvWrPmX56R2TuoLxZFZGXsXCUYNmlA90WrMKQr0+Tk9T3g6MCKZ13J6WL/6FHW6l6sW6PERmFc3jHKWIpbNeCgtZBqYVDkzHF0sQv7DhsVnaleGYMzZ/Xp6tX2OeLcnXmBSLEiJTwtPyC/PTPc639uMbjnyaO04tYtbuFTyxGiJQKSmxuaL2NKpiueflDRnKOT6HaNMlKXVoktiaUc7I1dMdamJvny8vxaL/wGr9QGdNDqT7eiWqCbxvx3s2fWKvQEa226J/3WF7SWdJysrIynMYrB3vjUz32PWqyWbi61NTOzZCqHq7x8Pf4k+mpCfoVKz0jh3p6XyuGTmGhPTkjmLExonYrEBsctgYmjOpSlLUbksXv0eS42FixphtvkaPIbHRIKKQKJbNl8Uvi/fHO+/tyvJoedp51DUTur1hYdcLKmnmpOzUNGxkHXtsRkdedmau26w7rHytMycHemTnJuit/NKOM+T48g3KJK3/Bqu5o4A/Z7IadDpHWgpmfG3nAXU7frbJwwl9r3ZO+EqGc6u3WOzwxWKHL3Y6xQd2/WKx1xffww9iA8vvfFccFvmxQyQ/dohobIv5rYIVSwgBrrAW9/TqEvqI/+zoGTeonet2J0zQj0cwsPPRPkIHwUux86BYOwYssqJH1NzT7BmXIOruadYqI1zYG4/dVQbTPKGDOSXVFTug3Wqedoy7kzMVsYiGqtuNrh7J4uQcs21W/Zbjew2cf+G8SRtDxmSfB3uN+ebS9WUl1UPT3INmjMo6LlTRMw2bPcJpM62eMGPCxrb5K+85c0x5qWI12sUZYDceKZ92/Ij560JlZzQel9indABmxjb8VLdTfQKrZpO2vy4bzPMcsfPVEQsR+Is9Dicf74gdwI52/n0okYWScJaGXPjww8nSsRPnhszBcXkOt7/SPZ7R0sCx8QjipUVNi1lbUCtoaf6xpIeKdp0iiI6IhLHbdhOLkVu73BiUnYrBbDKlZuS40woGDwuYEul0NCT2SE3JcBpzRw0rzrBn5WTYdCpX56dkusxmsym5//ihRyImq0mnw4d6pslqxmZjNW0cUtbToZosFnOCFzHpjdVSpd7L8tmNtFoG4OLgEnPFhI/+TnwM7889CMZdkIM8PLW983sRqBTpSuFmyFAfcdkQdUYwXhTgQ6zc6sdUtPoRXKt1QEHvyoDVlVHpGq/NMy0ErkSOjTc4oIDNmcPnBIPaNz6C2Hi6Fz9q40mWG89PbjvdNp1SU1JPX2bAbdW99qrO6s7ukZHr4mbu6fjOxJN6+jMCyRbd08/pLC6fNyM3UTF3HOybkGTTq2KFNnZcJTZivS0pge/lOxOS7FitFmNHG59kEPcNa7KjYy6il91xiboO0cthJ1H0vIjEYARhqJf39nKPWKJ5Hp6XMCRB6Wnm6SGkh6XztCIR1jTuq0yzJFVaqnSTWBWd4cUlmDWIAZ8zBzQHkbAdVcgTK4VQZKkUiaFJeXk9ed6gWAg49iWx1FKSjUrhGsOAgel+l2JYZ3aqHQ+Y/ou9LwFsotoanpnsS5t0S9N9utCWUtJJF8pOS9dgN9NSBBFIk2kbSJOQpC3FhbYKDwQVZXHBBRU31CegIK6gLIooWpBFReGJKE9FXAGXwnfunUmaFvDhe5//+977k0Mndzn37Pfce2eSoE6Jj08Kl4lIUnBWHJJEx6aEiM9tVIeIlOHB5AhhqFwwNUIbDDlXFdSrow6EKUSiYG0oWovLqR3UXHEIaJpHTEG6bpBF5b1EXgXJZyi5qEAdktASJROkr9PMzl6l9AjcfC4ZgXMJbErwRiQMI2nS19k0s5XZq2wYkc8bnH9Jfrd/WWljWD41NyoxRKMSZ5lGj796RDRdOH2c3pguUUWHh0erxQvTy9JTchNUyvjs1BSDjvpMGSSEjUdhlj6r2jq61F09JDWV1ImkQoFAKBWdq9Xp6Nyi5JTSvMQheWg/ZqN2kz2iGGIoUYo0fjYpmoBsMKlAGS3fnjY7SRUR74xw983877aHYi2D0uTbbX39lzHfh6F9FTfbhWQPJZSIpApVRIgqlk7WiNScMlHJyZHajNTksOBEjURICveGaIMlIrFIoU2PO/c4qCVEulFaJbzKEtIjpUKpODgStEindlMTReEww93cXiGJfI7QEinkzQUynRaAiFQo0QfwNYosBWSr5wtUBJ2sGOxMVojinCFukdtvq7AjWot2CXirgDcLvp2CP77fhCU13i2VhJuvuflhaamcNyMj+eObRELViEg1Ha2Nh8PAnOsFstBYTTStFj/9sJhU0dFRcSFSgccNYRkTEZ2gosQPUF/JIP1TIqlo926RRCQQQHojleekQdAoloheeVWIvCoJkv0KFkggz1CNYIFELnJfAN9uelYqlUduJhdtTNTQMk34ZnJxgVKuiXVGyFROmUvQxumMVNaiHWQ01jgLqyr3w9L6piO/ec7PF/RlI789UJVgSEZknIoUVh6WkMHx0drYEJlwObWAEofEabXxKlJEqYIUQmmQfD2lUYUrhZREqTjXSpG3SORSATph8icEwQnY24wijEiT9WEZ6CO6CdkKtKtREwnD2bChwdnCqBQ2yrvF854K4DiAhA8egKK92EkAztXJYhCaO8f1LUgh4WJJzjDIuJzbIgQnZGGJ0dqEcClFkuqU0HPjxYrQ6PDIWLVEFk7Duo06KHViGLlFhDo0cKj2nQSojujCqJj82N5uWMlhAsL69K2Y6xP3dsWPjo4bFk3Nlyrw8U5CnD9PrETai16gUqnPIO1IBKXESnTTg4g//4PgZiHaM+FTwsbg4FhiCOx18jeOGELHDEndTA0Hpw3JZTNiRImsZjM5bL3Iik55fFD7eRh8jKwk43FFCHmDDbDRwc8b0tgs4rxc7GW8e/FbgTSaSGQi8Hw+l4RnpBdPqBsekZ4cI5eIKKVCHB4zSBuWmJAQeu52GRWamhCTqAkSPh+VHSkMSQ5dBQfhQbFxyWoxOWTG3OJosSJYpgRbJsQqg5XyaCad+jQsSiUSylSKcwtznXlZDVnkSrkSZQRFRAiyEn82oMTEWWwd2PUIXoQ1Kp+PmdA09JHoeB1M9Z8hZuJzDaEZwTqhNtmg9a7NA2NmAMqlYuaCkNHgiPEPmBdh86LVQlwIBZH5sWhPHBIdpokNkaAzJZMCrVkx5I3ioLDoCHQHRivhNnkSSpx2ZVp6ZWrvaRws0CJYAHs/gUrVeyatMjXVkEyFoB50WgAbzEE6i2ZSqei3sQixoGQOsgy/WlNi9JtlUOf3PlBHv6xFEYTgeepL0UwijUgnJnC5Mp58CbrCyRcLFPLkeSpSFfWGKL2cGPdJ7/Zrsn33CFTJKhWpFqhEUW/YRAXQrx0XvWfI9unTrsn2y/rem1PePa/vZhX1ZdIET22FuzJNEpag0caqROGDR6YOGpEeLlLFRGoTwqS9GlHpCMsVQ1LLGgvkwVKhSK5W0MPSNZr04bRcJRcJpcHnmpAGQho0eKG/Bm9jDXb7NHhflG65tAbvIw0sf4YGK/IaDJlpJeYxXg3iclI1EWm5CfJgToMugiLl50+Th0XTiAhiMDEIz2bRoJhKdSnE5cd7QNJNokEFuA5BGP3xHn/hBPyyEhE28G7gKxJ0Ny42VBJCSiOSY2OSI6TBsqj0hITBWplMCyfT9CgZ2QqhA3tlCKoXlaFKkVgZovx1ROKQGIUiZkhi4tAohSJqKIqSk+dPks8Ip2MJh3M21lAWgiYiqBGbFOoMkBeSy8d71Nu91t2EGgtiUBKJRu1+QqcJci8l9AoJrHaaGEgEIeKwlNiYpDCJTKZJiYtNjZTJIlNj41I0MjIP3f4SwIU6r1TLRSKFSvkbHZemVSi0aXFx6VFyeVQ6yLxY0EjdI2r1t2pMapm6DKz6Tja2akwBriOrvtPP5V4BJQNaNBHUjWJ1ZGioViWOlIcnRmoTw2Xkub/0a2NSBQu8ZiXf9ZbO6fu3qdXod/QaiSnCq4VVhIRQEZFEAsRwFuSscUQZUU1MIqYTTYSDaCfmkRX4XGyvabbV2YbPuW70delOT6aHnmFJsUjLK5QVREGxsFjN5Ibn2q7zWCqKc3OLKyye62yS2KumamMnuNqq2sbPvaH0huyZ9mH26CnT4qeFGus19dTIseKx8gxdsK7tBvu0+rE63dj6afYb2iSpjQ1JqUTWO1nvhETChge/QnLU72T//oVEI0L/yAg0D4f/c/IVpBLarOg/KiJ2c3JSXm5Odhr/Hsa/R/Lv3n7JgPrA94H9Ek3/+qAB9L38BO8zubnMcnQ5k6PP0aeg0rn8bHg9naPX51BGdO2NRg3UjT7c3r8yudnZKaQ+N1dPvoE6z01F1zMIezkqCVbChYHauYM5OfojUCHvhEI9onYtXMhXsrPyesuhtIJhcimaRzongcIJNOyDXCZXBwVYJ26l3hUcEZ2gxOhXFGFF5euwC5uBV9ShUehLAMmMHL0RyXmbqfkbdZEKQXw6KsW7vXto78J6Mlt9Enn7BSLvYpj+d2d9ky5EwN9UFySHXXBzlrsXxa2wRyTqqIiwmGDJ30mZSqNSa4Jl5GGSlKi10KqSxIeVRtJRavEuwT5JaERU6AR5mFJGHRPBMgsLrYgq6H1ZIBZRAqFYCOVtvvYD0RFAIqT3eyooNFolFilDgvr91qkSWSIGXyZPZsBK51+U3EYxkp8IASFdDykoK4fRCxIjEkuptt6bJT814lFb/m8A2fUfAT1/DlCT/wB8/q+AwCPY+6+CsOu/H0SKfwOsFSf8Ltz9O/BbH0iul3wagP+/QGqStvxD+JGH3/5VkLXJui4bFvFw+z+A7+W1PKzpB+f+74CiJgAB+O8G5X3/NDwSgAAEIAABCEAALgeCMgIQgAAEIAABCEAA/stgeAACEIAABCAAAQhAAAIQgAAEIAABCEAAAhCAAAQgAAEIwH8BGAIQgAD8pwD+HtxQKgmuAlSk1LhFgL9pGIxrAvzt9GDhOr4sIFKEr/JloR+OiNAKP+XLYr92CdEm/IUvS4kM0Q18WUbQkm6+LKdW+/AVRL3kIb6sJDIkZ/lyULBY6pUzmJgAOPw3AEmZJp0vk4QkUs+XKUKi7eLLAkKrXciXhX44IkKpXc2XxX7tEmKU9im+LCUiNFl8WUaotV/wZTlZ48NXEEO0Z/iykoiISuLLQRJBVD5fDiYGAY6AIIUyEC5U5OTLnJ25MmdnrszZmSsL/XA4O3NlsV87Z2euzNmZK3N25sqcnbkyZ2euzNmZKwcFa+mRfJmz8xMETWQTDPzpoVSJfwHXRTgIN/w1Eh5oK8K/HMz9frAJWqxQshM66CkkbAA0YYS2JqIZ+ty4xsI7C9htcLUAZhBRDqUGaGGJdsCoBmos0KgjOnCJJiqAcgfQbcUcbVBqwpLQ8OfAv73r8vGgfTIzRA6UUn21fCIT8zcBBSfg0sDXBHwQDTMxi8edALVmaEW9rSCf26dPHf4FYDeW4FLyNGI70MR4qDdAD2o1YSv015Gj4+A1pTGXVug1Y3291m2HsS7c0gpYFmw1GtqbcVslYQCZkHWseJwd23UUHs9iDJZoAZ7IyhZ8pXmJvLg0bndjn1pBFq/3+vRA/R6Qwgoj3WCFIqyNFWti9elhgr8WGMFJyOljwjxo3tdWoIiomgAP0eqAWjuUPNgP6LelG6BswzK5sC2Qvui3q5t4S3FUPVgnjqcda2TGktoxFzf2kwF7pRFaTPi3k11YRxq/c76wYp04W7hxVLiBqomPV+QxJ9/u5dICdGzYPk5eSju0tGCuHE03tlSfBIijE+vi/W1tzrac7DYcNSgSmvnIRVKh35FGv8/twTU79rU3rjmbcVw4P9p5vRzYtg0Ys09if42Q1ebgcZzWs6Cuw3PX35tpmFoLptCB7dDKz1J/e3ujz85HMtKf84sLR4M3RlnsaxS5Tp82nIxNPI4banN56h7QgvNQm89LJhwjaAa09NPLm3nMIIkJ8zfz/HU4uzRhX6GeC/PVyAu0rucjxxv5w4BKNlwvHekezNOCIxFxmeXzQd/MvDBPNvFx7fRho8jlPG4HfBbHzv+bfCsPZNz/mIxbAZKYiXQ8ywbz/TRRhqPCgSXzAKB8NZLIArBg26KRLRdEj46PuSwod+AYasJRhHzTAa3ofxDgbOylytG0YRmQBI1YWi7PcbQuFqNuHOdOrDtnBe845NXJmAeXaTqwpTnLeHze9mJ784KZz91olmdiGyA8Jx8V/nnaie1q5/MDR4Xl6yY+J7M4o1ixhpx0DVgOr5cHeszDj+Dix3VBS6NPh8zLygTcqmDBNvXwqw83Pzm+mT4+AzXgsmg7/z8RNF/CZu28plY802x4TnEz/0LbozHcypIO+IP7RfDFqXMy/LO29Z8f3OpO8+uzB3vO3G+dHKhB36o4UK5RfjGANOF04XYL3lzp8u08LHjtteM8YrqkplzsmfpFFZcPHPyV04ort+L5wuUnC17HrHxu4eggTBvO/peOUS6L23nP9FH3zhCr366iGec7K29nlNWDcL5keR28OwyvlftHdSb2jAmXLYR3fzUwzw2cCekD8gKL83Q73lFYsfeRV03QhizUBBjeviye5vQBuXMwP3v7skXfbsArzR9ZnS5zNaBjB9Co8NKg43zRjP6nD85P3qjhdic2fhXpi+7fW+G8UXnpVQ55rsY3c9x+exHO31wUsDwvLmPbeb9nYp1d/Orj3Vdw+6Im3s/eOObiysnvdzgODrzvNmE9vZFiIvpW+YH57E/whc9CJqw7spuVz/UWfq6a+b22Hcvqv2Za8W7cjWOTl/HSvoVybf91Hrw92M9GFr8Tgv98uGx6RN+pxot98eyWOSC7eW0/cLQNnwqsA/T2ytW3B+ubNX0rkdeHmYT3dIZOYd466xchTnz+suF4a/ZbYTmpG7AsLL9Stfp86Z9LOB9m8R5341li88ngndf9Y+nyreq/wnNa+q80/WO6zxLt2I4t/6QfvatBKz5dcpZh/SSw4Cvi2WeXmYBh9ls7PL+Tj7nMb8EaeFe8kf2yOLcba8Pli+267XiN8K4y/ucz7zpxsZzSf5Qb5wrOVw283hdfc02X8KjLp70bR6kdU+dm0YUn3382ArzrWzlRgnuriVKoTYLV0ohbDNBGQxY1Qk891IqhtRha0gCjlu9Pw56ahNehcsCbiNc4joYRrlVQn4xzXClB4zqqXQH4VUALjS0hrsI8SoBaLcY0YtqV0FoB7yU8HhpRBC0ToY7KZTgLcvyqYBR3hjDwayInaR200z4N+0tlwBy9klVCzQj0y/neQqBtwPSQ/Ih/KS5X+eQs5SUtxDZClBHNIpCoAtdQ60R4rwG8Wsy/EOvMSVuFdSiFfk6XEiwB4qzjdeXwkH3q+R7kIyRfBUCfVoXYBuVYmj77FcF7DUiO6JdBbx1eIaphZDHWtBZbr4S3GdK2Atf6tOI8VYS1QVZFNiiGciX8lflsZ8RXThajH7X+tpuE+/uwOP0K+WsRtlw1rnHeKMK1Ouwr1JvJ+9KI9RjIdRKOxBKMVYg1rvVFSCmOXk56b3RyPKr9JOH4Id/6y+KNavp35ghHxds/kff0hXZBVi/ENkFy1fo4X4oyzM0n6GwmW09XWs0uh9vR6KGLHC6nw2XyWB12HV1os9FGa1Ozx00bWTframMtuqBytsHFttPVTtZe1+Fk6QpTh6PVQ9scTVYzbXY4O1xoBI0oMzl0KnrLz6SNJpuzmS432c0O8yxoneBottPlrRY34lPXbHXTNn86jQ4XPd7aYLOaTTaa5wg4DmBKux2tLjNLI3HbTS6WbrVbWBftaWbpSkMdXWE1s3Y3O4p2syzNtjSwFgtroW1cK21h3WaX1YnUwzwsrMdktbl1QUUmm7XBZUVMTHSLAygCI5PdDWRc1ka60dRitXXQ7VZPM+1ubfDYWNrlAMZWexNIBagetgVG2i1gAZeddbl1tMFDN7ImT6uLddMuFtSweoCH2Z1Ju1tMYFizyQllNKSl1eaxOoGkvbWFdQGmm/VgAm7a6XKAO5C4QN1mc7TTzWBd2triNJk9tNVOe5CxQTIYAkragZejkW6wNmHCHCMPO8cDg62zWB3Nq5nmpltM9g7a3Ao+5eRG9rODlV0m0MVldSOTsqYWutWJ2ADFJmhxW+cCuscBCrUhlUw0eKCF44Wix9xscoFgrEtnZJtabSaXL7BGelmPRAGRVw8mQj4Ypsse1s/0HpfJwraYXLOQHtinvtBsAos7UbPZAerbraxbV9FqTje5B4Mb6TKXw+Fp9nic7pFZWRaH2a1r8Y7UwYAsT4fT0eQyOZs7skwNEGgIFTBtrWaTu9FhB4MDVh8zd6vTabNC5KA+HT3Z0QoW66BbIYY8KFpRMzKEGVzrYTNpi9XthAjmHOp0WaHXDCgsvJvAjayrxerxALmGDqyVNx7BVBA3Dpe30Ig4ZF6oO8SBpdXsyUTh2AZjM9EYLwPwT3uz1dzsJ1k7MLXazbZWCP4+6R12iJR062BuXvihA4Xfk5abRhDr4He3x2U1cwHpZYDj0EtrFLZAuhW4wJxAucSFZo7F0W63OUyW/tYzcaaCyAJ1wH2o0OpxQhqwsEhNhNPM2pz9LQqJCWKXQ0cOseJ50mxtsHpQggqqA5EbHWi2IJF5U2fSDSY3yOqw+1KF1wnpfCywdl27dZbVyVqsJp3D1ZSFalmAOZ1PKoPBvTgs8BxAZC6eBS+WvfbyGBUIYx8y80wH6IRMA3PJBpkNm7t/nkSm7Jcpg4JqkHPcePKA3mACFkZBYINlLJl0owuyHpoiMBGbQGdkY7AVeBSG044GyHZ2ZBQTztTeOLt8LZBAJrfbYbaaUHzAPIOUZfeYuIRqtYFl0hHFftrStXyq3jcYS2TB2ZDzw0XxcJ5FzX7hlsmHG5Le222zQpxyvBEtF7dUAQc8iZCGmSiXWxvRO4sN4mwFhdzNeMIC6YZWNHndqJGPEtAwCxR3syhFO5xWLqNeUlRuwgNLbtLwlsZCtDc7Wn5HRzQNWl12EIbFBCwOyKFYlpms2eMNsL44huC3WPHEG8mFOKSxNtZvxbU7PGjKcMncyk9jLlL4LnczWg8a2H4z1+SnqAuxd3sgmKzgIt/K83sGQPOtvISurS6tm1RoLKENtXSNsbreUFxSTKcV1kI9LZOeZKgrr55YRwOGsbCqbjJdXUoXVk2mrzBUFWfSJVfVGEtqa+lqI22orKkwlECboaqoYmKxoaqMHg/jqqphYTfATASiddU0YsiTMpTUImKVJcaicqgWjjdUGOomZ9KlhroqRLMUiBbSNYXGOkPRxIpCI10z0VhTXVsC7IuBbJWhqtQIXEoqS6rqYMmtgja6pB4qdG15YUUFZlU4EaQ3YvmKqmsmGw1l5XV0eXVFcQk0ji8ByQrHV5RwrECpoopCQ2UmXVxYWVhWgkdVAxUjRuOlm1RegpuAXyH8K6ozVFchNYqqq+qMUM0ELY11vqGTDLUlmXSh0VCLDFJqrAbyyJwwohoTgXFVJRwVZGq6n0cABdUn1pb0yVJcUlgBtGrRYH9kXVDguUDgucAfsG3gucCf91xAjv8Czwb+M58NcN4LPB8IPB8IPB8IPB8YmM0Dzwj6PyPwWifwnCDwnCDwnOD/3HMCmJsC7pP757XEAuJiL4r/RD5BpsN7Lv5k/++9igV3KpUk4JBTLxc/KAjjL71cfJUK42+/XHy1GuOfvVz8kBCET2VeLn5YGODDO4G+oSDE+EICfXOhGAZHE0HkEiKa3EkMIt8gGMEEYgxgToB+44Ax9X5jImBMMozRwZgRMKYUMOugf+qAMRv8xkTCmFQYkw1jxsKYSsBEPmD7jyEj/cZEwZjBMCYPxhTCmBrAnAH91gFjOv3GxMCYTBgzAsaUwph6wGyCfueAMd/6jYmDMVkwZgyMuQLGNAPmXOi/CcWXVEpK5du2PQKvu++WikipRCqdsxBec8QCUiw82oleYhEhFi2soemahVJcXFgDlYICKUlKhRijk+gUCEipaPXq1VIZKVW81vla50MAywEWAshEpAwoe0kLSbFo3VYvaXEfabGXtIwkZTxpjrYM0ZbJSZlyK7weLHiw4A4MSwDkYlIuFQqFniU33XTTEo9ESEp48p0SESmRIJo1NQvluAwV4AAs5CQlF/lYdAqFpFy8FF5yBSkP2jpj6wxguPp2+nb6ZoCbABRiEv1P3n+Uj4KkFF4+PCMFZqQIIhWqrdqt2tXpq9OXli8tR8aZL50vRf8ZK6mUUfAaWdoNr9KRUiEpFfO8OrGfsKGAm0ICTuzuLi5OT1er1TStJCmluLM/P6UE8VMGk0r10dijsd+Ofi/zkO2Q7c2Kt9/evuSNJduU25RBUjJILoDXqKZt6NU0Cvvs0NGt3EsmJWTSbY2No7WjGxu3KWWETIacbCYQDAOIBdACMEQQRQWJt/pexNatIjEZJH0bvfzmNMpplMVmb+LLOjdXRnNRV+gyNWTSha4WeyZd1OGyZdJlrGMWvrrg6mKhjG6gZ9IVJo/9j2FjGUgsB/wldsF7OCdSYgfTndgqlmUsKF9wJoiUUKu7ExuhqYEiSb2KCRLLZiwoJ1mBkCJFBDNbLB8iJoVkdz5FClebGROT6dcS+1B8ZywxGkM13u458AEMHQ/GImD0AwgK6WJKs1GVt36JaUvrS8U/npqw8m+niw0ZXbc93/PMCtPk8iOruxUzmW7h90y34MPVAoqkqLAcSHjGv6155uiaHQ/i/89NaERkeQ1IBch5g17ByMSCiUJxGDWxVh/GhKCKNEw+yeRuttqbPA67Xs0Eo0ZJmMTIWlocdos+nolFLfKwiIs+ytanM6moXxCW4N9vYelaaxN+IFJTVEhng5JMfGRQtp4ZwWTrh2cP0+dPgWo2VPV8lfH8KfLx/YJL9DPdZJK/ocD+gm5SRUC7nOqGRWXjzafvJu6YMu7wfS9c8aVrXJOt0jVk+s7gl2ueWqW8VejYddb67LHpdbcfn5awfUX9NUt0TsWVugk1c396tttq/eDjdTs/PX5oot5T/9aSHFHTQn2+Oi8tZmxKuKniTc+GhZNGFss3Uz9/WnN6vumbZ8Yqjbd+f+CXqvqnR7xm6H767vy0ZY1jbnz6ylc2zXVX93x1dlzLymeUZVeWVYz5bMvKV6Keq79KPTftamvUD+a/JIhG23pPfXn2g2ey5z/+4esPTi3qWDd5+a6kQz2f080TMj7fed+JSab6L7qf3GNOOmlvcGTt6G44JTysom7IHDPxk6YWxXLz4Gu/W7lWe7p57+n8bafG9Ix7X/3brpaeh8MoAUyRh7vJ2WCRFiYMbBk3SKhk5GIphLhIJBEImDjUGCzUCMMnPBV1x/XdT7ipxkNXmz94LPhl0zdmpg51hwgrmSvWGJgy/VBmCHKIIiylzyEGF2tDT1eqnSznFjddgZ5AsRa9hglH6KKwoOyc7BF5I4bkDsvPzc9jEhDVZKGW0XSGf/7b9GtfSiKu+sxVtfHHRE9y9uennmLqEUKCsJoBxqsNq8sWlPAPI80u24An2M5ZVtSaxT8LdmeBZBDDEMEQvNNR8A5l8ocyw3SAxEzxak6SwiqmgpngrTPUgrE8i/b29ouxYF2/S9vDKJHMsJU5L6QYYsD8FaBobDs+90rPWveOh5/PLanSTXm28HDlzbOem/TIvNavlYNf+tuY5WdEH32xbHL4qdsWlz5xbefWG3cemvFeyoiUhaO2LdPHv//yHS/k/TxU/Pm8szMXdrxwrG3woMwfjj+Wse380qMv3Pr1eVb9t/xHju9fdmAyozRsXrtKJDsQ8bX+5X3X1P92X96tnz/w05i3pqSt+G1+ii50Ehv6vrD6lxr6wOMH2xef9AhrNt26/fbbqvS3fRl+Q9n+X49qTjunT3k3oTNyce31P7QRrz58es7Uz7+86dryNTvWfvX4SxJx9In1Pac+fP37L89U5I/5WnNksmVD2muLe9Szz6W9vrbogbUb3242fOFkl0/I2R4VfPKr6sNRV88+xHSLnZD5ruKyntykNFbgjC0YmOy6Fv4p2SSbYbhsMriv3+hwABL41tpoNZs8LF3Y6ml2uKyeDl/eg2s+MyybyWW4vJfHVfNQ9d+el/9RBvx7sKWmo2nj9mO9MqLi/uVPnalv/rL40Ls7rqp+4pG261pKXtw34o7n1sT//DPb/Vnk3tt6i++VnmCX7cmceNOW66XHdEMeLxyiff6hK+yGilkRkk969r6+KH728nc2zrviuWekh95eeGBW5PKRy/akjvv683O5d03aH3eN4fSGDN3++S9NHnd26XNDbvS8NeTZUaXHvi01vBbZWLcr9pW47RMbJrnONr0wiM795JpHH1kx7cn0znf2b7j/uGCjed+G8Ddfe/PmVPnkeZKvzwef7AzNqwh99FXj1T89+uHRxYry9gPzy/arX9h5Yu03i2cOFU2dsfO5jKvvTY6dXnIsOjzekb87Kqdz5qLKh2c2mucs28+8uyLBmwGPgUWOMGqxjF/bI0ghRCHhl/4umoeifAPCKaEyXg6HQHTbp4goZBRopEqIyCxgVL65L2IE8NYvw+0/Xb/7thMPTW1o7hmzfOnVB/fco93+r2Y4iFuIWghWPgsNG5qd87+V4S5B28N03YeEpoVdK5iuO5iu23zG0QmYri5mjJcVRWr0l2RVc4UBfxApq6imNsvCNppabR5ds6eFKfANp5jc+Gw6Ds7i6NuP6L7adKIGb73QnbIOqNXyd4hZ331yHR13Qc4FB0d7Tk2qHnztds38OZtr9iX9Jrvvqe47z+aez8i8c0Xo8c+2vLtl2ZvHcp/4qGvz4Xji1b15jmeOz+tY0X6cev+7rw69UxUfY3ro9SnJ0d8uebzhypIm6bFxo+OXnWXmR745ouDRg8HPJg4+/siD1iVJy9723PXFg2VF39c+tVXFWOed2zuIbnGY9h2R7P/ARWRaF7SNufKjR0eU78o3tUg+ro3a/dgB0+tbPr3xSdXRWatWHLg+/cp1iyZcueYe25vPJ0yIDrY+cfDwazf0GJxrNz39kqvMHPnLowceenTB14+ri1eZN22wLhK/UbpgrnbciR1xifuv/ZlKHrqjcPeWuIo3NafW3zvvt6QrDDfbI449Oq/t6p7ajtvn37d/70dj3Hk/jP5r3QZj2cyta8NW7L015MO7m6ZlL/k1f37P4db59/5l55RJ81/f8nHQbUtWDf3quW/eTdu3cZr1lzUaIflYSpP73crqTZ+I6u+ce+bvxsof20XV83ceUnx368nxsp6gtmPJ9XOSUoe9+tb6Jfa1cZ/N/7Asp+G2Nbtuz5k+O77gmbvYXUknxicOujl26IwP8hcVLsrQqA6aRi9vnmE8daDs7tWdBd9EdLWPvfdorTa6Jm74ilXxjTlhaSMi5/xl2J6qbdM3/DSmrHbT0eMfKUxjMg7ekbknf8rYgvH6NQlq6ev1925JueZK6r6ZHXsj93342vJbJdcOml38pHjm5+/vPJJ8z8rWHfruCCvTHcHC5p+BsP03p+tLbvX9ThCru9ahtMMHskygV/ofUUCSvppCH8z490YwWX0DhfokIR2foV7XkLuRWZaXs/6eqez8Y6d6Ozc8L2iduzg+tuuvcx5iiv2GK/XDmNzV4Z2hFz7OfzC2M9r7KcL2C+b0gBVI2E0ST0WcnPOFVvDrzqI9XQ+FvNr78k8PLV828eHye6a9dnJO6Tzp2PtPhLYfeWf9REvh3K9n784umvnBuB+pyqCUXnFljCizJ27G7B9far1qsr7srars6hvz6fVPhsaJs9ccu+WRLWM3XxPaYz04dNN1e0OSex7PPD/vpiMjjk0pqxp6zYsZN/79t7Hr37yVktz/xIpvilwzp8b/OG5TSvqvbe2HytdLikO+qLp5sTNswbr3DrY8JTkgXFDU+1n940/ue3CJfFfW7o910lH3zQ6u/vXlM56wW/T75hRsv9fy4eNzdmkbie+TbK+eV/bMm7rpHWVp5LSliw43pdTOeuue2Jjp0/5q6VH99GL9oW1bHe1HD25uij/9YHfod0x36EmfeQUCUt8d+jG0fdDvbBr6FjTtpEjBhWfTbnKiWOF1pxqOp91kMdi2ADpGQzzzpG+aLBeQFzmH1hy5TTzsq/gnu647cn5HPRnxmsC8ZENefca2eycIRqVMvZMSm35L1L5erg3LZuAsB6c5dNEzOv2w4VMYYSdF/ri66/01XT1M154/ZdYMZtK4s4TfBzr9zhA1rbAeOWij1ezQpzIpHGpcXbMJfZqurraWLqmtGjl8RH7h0JKcvGFD9flwGB3EJHMTMbaPZJ21hR1a6zG1OOla7lOiq7uDi2Ef+hOcwD/uO4GTMyT0t3eUf/jqV2hakjMGbkqv+1OMwGsmCIu7qMQDzt96fa5+BPIWd/7O1ev56n+dj/7hxvY5fWfse9/vfPs7Y85Y2S0/5a2Z8s6a74aOZytu+WL74rc3Pn/wgSHsA3s+nfZy1KuhS6s/FRWvOTZo2rrQW+sXfZT5yhcCKvKenYkPLL2yJ+Ld5P27F4/ev3ZXXaf7h4ofW7IP2H8Z5erMMH32xpebtff0Znjih/+6vOCrXM88Re+87al375LPSIw/ToaWWyNMX2StfOLFR1uuECV1ddRcx7x9u2HN8e8a3st9YdaTzWuvkVVs3RO/bumjM7KLZ03t3X4+eOqz80fNXnjXLctLV7bsfOarXd0Vy9Y98vxw7bJNpSt7T5x8xHHHl6u25H19ULM65/XPbrzlU+ldx+4PefK4YN8r9Uvv33mL++81TzxWGHPk4+Ev+o72MWCRSL9t7GOr4s8+/3jk0Xv+1pota73uva9eTTD3342aR069Wb/0h6JrryuN2ZHTPGV+y8R/dTcK/gPv9TsT6/+3dqOXoD3wvH2RmxvSix3CI3Lvkq4aKXp0UU1rdZrpYOSplEfSi8588eHq46q9mvs/+XTsNYKJN9yx+/PBBwoPDDevixmWZK5KOnyLedam/P9px9zjoc76OM6Myww7iIQpd7HYzG9IEQmNFLmVGhq3SVh50MQ20jbMkBhtNeSa5Boy65JM7lK557qP3Md1KKlhljTI7PCsXnaffZ79s93n9fxzXuec1znndb7fc87nvN4fyMBoLE6SQ2tlxV7gCEjQG1mRmosdcf6Y61Jle+69q2exmZ2qKwsFqn7SFZYoSETmkHLj/jcWqYdAN7R8P6i9bV8SJmPcLVgcDDhRrHI49Fb+/Vne0LJXgkqySp5RRr6tUdlhLeo/eFXvCfdx0El0ha5pdLiH7WCtHSLmZKlGy1Pa0/yikidgbtuR5NBc//f9J3vf48twlP69pbkNcvt578P7xm226wrY83mqTs7Ou0KZ5CPbu46r+LZ5d4cFoCSO03LL/8mFcBxX/Bw3IRxK1NiAcNDfAMKR2kidfbq6mxDObe5db35haf4zpcqThVXht5EPKMyuSiQsLod43/EJtBfryRbiIV1beff9t5bfuNY/Z2CfXXpi5KmJmZM8qcaHlDfZCY+TbYdK3PweCzgWAyjRebfIcPvDX/ValelBSkyHY6mvAgC0KinTDNY5s2hObKtVcdN2cDvCcjCP0A6XC8R6UVyJ9sUdscdj6l48cO7CSvh93QBnR4RWjmBXj9Spyap4iV+EK5ILLc9F2Z4tdv6Elz84h/6OWk02tTK26xJNETDyCln0fAqORxGYnZaf/BjJLcW5rGANIeTcgLUAhRYJ0X0dtKvoTVKb4TQCVZGzMHSuOou3TgEaG9S2WvW0GeXssiOFl99GyWpTqaa4GRn/rwj+h9L0fwT/DYKnbSD4eph/IwoXnIq0g403jCYeIuLAB+9lpiv6l7x98HIRWdPBP563toz2lQFKntV7Np8fWZyeC6puzE3dPcGueudjj4Zo2pFQ4ivlJ2+8XHATJ196aWxscnfISYrjxHaR0k1UOW0ZyDQVayqsDWkIYe2/eubQLlbSZQvKCZ5CPVGpRcRlokd/XqnPZGP7h5ZgHn9LAKWiZNjxDpwdf8tRvYr2iW/swn1tC7VPpwoRazTGTZ3Ks67Jg2jjN/PtSZ63b3DOnw0ZrrcQpqiO68/KWODc711R9H2ekplhuBxyNf787aAHvt1jKWzZVb2+OwsN2ULxEVnVqfACPtOwstLQu0p6CqW7GedmlxZqCe6Ou0WDtfTRlzJwDwXIolE7KrA521qT+0TMk0PrO9tyOplXw+bGDHDQEefARCUIdqDIVs6/en6MZ2QaKZgVe2DJwzzo9cfco/lL9IsErI8/Po/YmgOl6lfONrT2kR5fbJNdKLvGKxe6sjNKw17/EWagCXYqKfh6gAFkKnHPzA+jOlri6otPEfZqiktNVOuBr8uK8wbjH+WYZjR3yJhYjUawNZIzt3kCP1UGaluOuF9ZTCIjdjYqFjqWFgyhDBNscb3p3fWnJrzp6LouOvD008spqxVYrbPNm3tyMnqIqg4Hfi0mLM1Wd4AJVdvVU0LQlYNUDOwb/Mn1Fj0w8ph4OgnUDZBABhsUvpr+v4kVGcpC3PAEBfg1RcAgOFiSZ0U7JvC7aNRQU4LGdbRkf2hef2dGGjEMIIZmEb7wn7XljfLz84D4eRgFkWcAJWnRzyyorbMfuffMZgcS+LUDwHMF5jN48vEiEVx1Evp1gXU1F+IWINAOERBXgQU36ttY/xpQ2D+wPmDflumgdevks4WxTrKgNCEAsj4NLJiukL5Z541I+92WwUQiD+HHn3V4oNgsUjm759vhfqXghIIWvhrw64m5CfAlmEo4n0cWrhlTVFJ/d97JCKevDMdLXun6ZpplkSQNEZykY64Q1C0JE8tM1E1AoeLocq44kSNBM6DDUmHPgvipbdlBL7D7LNSPvz380IY63WNoU/lRhtkZMxkhdWFgJh8eZ4IkgWFchoRu3OrYL3ui/xFhtzpLJF4LAL7VWoL9xl/4N/co1AvzHo4dz/+HS9RH357mQTWkVC2T5VPAke/z0wzo8QaIy1sWACGQxBmAOA0QJwFiNZ8CSDyzOjNAKwFjllMoN6PZQojr5txykoKOuxxdyi3yKAeIiX+Bp/DHieMGf1jmgJOn4AxD7iGdPUOZQITE/VyNdk22XGvpiVjrXQV+98+tm14iJspFZ1UC/Vdrkx5H6Bw7oXLZbqYMa6h1+rmwtxrtjnV7RwvewoU+5eB6es3ejHZ94SSKmqH8Sv6xQkyi+QkakdYU7WzzhHMin/iVtS1sUMED6d9RE55twJxxDTcbfquCyIg+hrMsn62LeiEWxuZcRrSdb0OPIRi7uymjqWt4e8lhKqxnNS+4PSSkKvqJlIZCCkaaPLFM8l2RE74mnZXc9QDOMspCvBJhYCjeAX2KEAp+hcomGHvetqsKsKmhzp8WS0r48RHDp9d6hVfAibrLb5TnII2Vh6Tr4GvAA0dFHn5QNCtZgyyXCjy2ixo5J5veROK7cPHuXE+MedNehjA3d78AZF6kWg0KZW5kc3RyZWFtDQplbmRvYmoNCjI1IDAgb2JqDQpbIDBbIDUwN10gIDNbIDIyNl0gIDc5NlsgNTQxXSAgODE3WyA0NTNdICA4MjFbIDQzM10gXSANCmVuZG9iag0KMjYgMCBvYmoNClsgMjI2XSANCmVuZG9iag0KMjcgMCBvYmoNCjw8L1R5cGUvTWV0YWRhdGEvU3VidHlwZS9YTUwvTGVuZ3RoIDMwNzM+Pg0Kc3RyZWFtDQo8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/Pjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IjMuMS03MDEiPgo8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgo8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiAgeG1sbnM6cGRmPSJodHRwOi8vbnMuYWRvYmUuY29tL3BkZi8xLjMvIj4KPHBkZjpQcm9kdWNlcj5NaWNyb3NvZnTCriBXb3JkIExUU0M8L3BkZjpQcm9kdWNlcj48L3JkZjpEZXNjcmlwdGlvbj4KPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyI+CjxkYzpjcmVhdG9yPjxyZGY6U2VxPjxyZGY6bGk+0JjQu9GM0Y8g0K/Rh9C80LXQvdC10LI8L3JkZjpsaT48L3JkZjpTZXE+PC9kYzpjcmVhdG9yPjwvcmRmOkRlc2NyaXB0aW9uPgo8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiAgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIj4KPHhtcDpDcmVhdG9yVG9vbD5NaWNyb3NvZnTCriBXb3JkIExUU0M8L3htcDpDcmVhdG9yVG9vbD48eG1wOkNyZWF0ZURhdGU+MjAyNS0wMi0yMFQxNTo1MzoyNyswMzowMDwveG1wOkNyZWF0ZURhdGU+PHhtcDpNb2RpZnlEYXRlPjIwMjUtMDItMjBUMTU6NTM6MjcrMDM6MDA8L3htcDpNb2RpZnlEYXRlPjwvcmRmOkRlc2NyaXB0aW9uPgo8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiAgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iPgo8eG1wTU06RG9jdW1lbnRJRD51dWlkOjZCMEVCNkZCLURCN0EtNDU4My1BNEI4LTY5MEZBNzZEOEY2MTwveG1wTU06RG9jdW1lbnRJRD48eG1wTU06SW5zdGFuY2VJRD51dWlkOjZCMEVCNkZCLURCN0EtNDU4My1BNEI4LTY5MEZBNzZEOEY2MTwveG1wTU06SW5zdGFuY2VJRD48L3JkZjpEZXNjcmlwdGlvbj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCjwvcmRmOlJERj48L3g6eG1wbWV0YT48P3hwYWNrZXQgZW5kPSJ3Ij8+DQplbmRzdHJlYW0NCmVuZG9iag0KMjggMCBvYmoNCjw8L0Rpc3BsYXlEb2NUaXRsZSB0cnVlPj4NCmVuZG9iag0KMjkgMCBvYmoNCjw8L1R5cGUvWFJlZi9TaXplIDI5L1dbIDEgNCAyXSAvUm9vdCAxIDAgUi9JbmZvIDE0IDAgUi9JRFs8RkJCNjBFNkI3QURCODM0NUE0Qjg2OTBGQTc2RDhGNjE+PEZCQjYwRTZCN0FEQjgzNDVBNEI4NjkwRkE3NkQ4RjYxPl0gL0ZpbHRlci9GbGF0ZURlY29kZS9MZW5ndGggMTExPj4NCnN0cmVhbQ0KeJxjYACC//8ZgaQgAwOIWgah7oEpxl9giuk9mGIuhFC9YIpFC0IVgynWJAg1A0KdA1Ns5WCKPR1oBNBMMQYmCMUMoVggFCuEYoRQUJVsQH0c4WDtnM/AFLcCmIr7BqbiHSBUNJjKXs/AAADM2w/9DQplbmRzdHJlYW0NCmVuZG9iag0KeHJlZg0KMCAzMA0KMDAwMDAwMDAxNSA2NTUzNSBmDQowMDAwMDAwMDE3IDAwMDAwIG4NCjAwMDAwMDAxNjYgMDAwMDAgbg0KMDAwMDAwMDIyMiAwMDAwMCBuDQowMDAwMDAwNTA2IDAwMDAwIG4NCjAwMDAwMDA3NTEgMDAwMDAgbg0KMDAwMDAwMDg4MSAwMDAwMCBuDQowMDAwMDAwOTA5IDAwMDAwIG4NCjAwMDAwMDEwNjYgMDAwMDAgbg0KMDAwMDAwMTEzOSAwMDAwMCBuDQowMDAwMDAxMzc4IDAwMDAwIG4NCjAwMDAwMDE0MzIgMDAwMDAgbg0KMDAwMDAwMTQ4NiAwMDAwMCBuDQowMDAwMDAxNjU1IDAwMDAwIG4NCjAwMDAwMDE4OTUgMDAwMDAgbg0KMDAwMDAwMDAxNiA2NTUzNSBmDQowMDAwMDAwMDE3IDY1NTM1IGYNCjAwMDAwMDAwMTggNjU1MzUgZg0KMDAwMDAwMDAxOSA2NTUzNSBmDQowMDAwMDAwMDIwIDY1NTM1IGYNCjAwMDAwMDAwMjEgNjU1MzUgZg0KMDAwMDAwMDAyMiA2NTUzNSBmDQowMDAwMDAwMDAwIDY1NTM1IGYNCjAwMDAwMDI1MzQgMDAwMDAgbg0KMDAwMDAwMjg0OCAwMDAwMCBuDQowMDAwMDI0MzEwIDAwMDAwIG4NCjAwMDAwMjQzODQgMDAwMDAgbg0KMDAwMDAyNDQxMSAwMDAwMCBuDQowMDAwMDI3NTY3IDAwMDAwIG4NCjAwMDAwMjc2MTIgMDAwMDAgbg0KdHJhaWxlcg0KPDwvU2l6ZSAzMC9Sb290IDEgMCBSL0luZm8gMTQgMCBSL0lEWzxGQkI2MEU2QjdBREI4MzQ1QTRCODY5MEZBNzZEOEY2MT48RkJCNjBFNkI3QURCODM0NUE0Qjg2OTBGQTc2RDhGNjE+XSA+Pg0Kc3RhcnR4cmVmDQoyNzkyNA0KJSVFT0YNCnhyZWYNCjAgMA0KdHJhaWxlcg0KPDwvU2l6ZSAzMC9Sb290IDEgMCBSL0luZm8gMTQgMCBSL0lEWzxGQkI2MEU2QjdBREI4MzQ1QTRCODY5MEZBNzZEOEY2MT48RkJCNjBFNkI3QURCODM0NUE0Qjg2OTBGQTc2RDhGNjE+XSAvUHJldiAyNzkyNC9YUmVmU3RtIDI3NjEyPj4NCnN0YXJ0eHJlZg0KMjg2ODENCiUlRU9G")
    ]
)]
class FileDto
{
    public function __construct(
        #[NotBlank]
        public string $name,

        #[NotBlank]
        public string $base64,
    )
    {
    }
}