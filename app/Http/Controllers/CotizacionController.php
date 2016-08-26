<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Session;

class CotizacionController extends Controller
{
    public function getServicios()
    {
        return view('cotizacion.servicios', array(
            'link' =>    'Paso 1', ));
    }

    public function postServicios()
    {
        $value = 1;
        Session::put('servicio', $value);
        Session::forget('size_1');
        Session::forget('size_2');
        Session::forget('size_3');
        Session::forget('size_4');
        Session::forget('size_5');
        Session::forget('color_1');
        Session::forget('color_2');
        Session::forget('color_3');
        Session::forget('color_4');
        Session::forget('color_5');

        return redirect('sizes-cotizacion-rapida');
    }


    public function getSizes()
    {
        return view('cotizacion.sizes', array(
            'link'        =>    'Paso 3',
            ));
    }

    public function postSizes(Request $request)
    {
        $value = $request->input('size');
        if ($value == 'Perzonalizado') {
            $ancho = $request->input('ancho');
            $alto =$request->input('alto');
            $area = $alto*$ancho;
            if ($area <= 100) {
                $value = 'Perzonalizado-Escudo';
            } elseif ($area>100 && $area <= 286) {
                $value = 'Perzonalizado-Media-Carta';
            } elseif ($area>286 && $area <= 572) {
                $value = 'Perzonalizado-Carta';
            } elseif ($area>572 && $area <= 1000) {
                $value = 'Perzonalizado-Doble-Carta';
            } else {
                echo "El tamaño seleccionado supera el tamaño máximo permitido (doble carta)";
            }
        }

        $size_1 = Session::has('size_1');
        $size_2 = Session::has('size_2');
        $size_3 = Session::has('size_3');
        $size_4 = Session::has('size_4');
        $size_5 = Session::has('size_5');

        if ($size_5) {
            echo "No puedes agregar mas impresiones";
        } elseif ($size_4) {
            Session::put('size_5', $value);

            return redirect('colores-cotizacion-rapida');
        } elseif ($size_3) {
            Session::put('size_4', $value);
            Session::forget('size_5');

            return redirect('colores-cotizacion-rapida');
        } elseif ($size_2) {
            Session::put('size_3', $value);
            Session::forget('size_4');
            Session::forget('size_5');

            return redirect('colores-cotizacion-rapida');
        } elseif ($size_1) {
            Session::put('size_2', $value);
            Session::forget('size_3');
            Session::forget('size_4');
            Session::forget('size_5');

            return redirect('colores-cotizacion-rapida');
        } else {
            Session::put('size_1', $value);
            Session::forget('size_2');
            Session::forget('size_3');
            Session::forget('size_4');
            Session::forget('size_5');

            return redirect('colores-cotizacion-rapida');
        }
    }

    public function getColors()
    {
        return view('cotizacion.colors', array(
            'link' =>    'Paso 4', ));
    }

    public function postColors(Request $request)
    {
        if ($request->has('add')) {
            $value = $request->input('color');
            $size_1 = Session::has('size_1');
            $size_2 = Session::has('size_2');
            $size_3 = Session::has('size_3');
            $size_4 = Session::has('size_4');
            $size_5 = Session::has('size_5');

            if ($size_5) {
                Session::put('color_5', $value);

                return redirect('sizes-cotizacion-rapida');
            } elseif ($size_4) {
                Session::put('color_4', $value);
                Session::forget('color_5');

                return redirect('sizes-cotizacion-rapida');
            } elseif ($size_3) {
                Session::put('color_3', $value);
                Session::forget('color_4');
                Session::forget('color_5');

                return redirect('sizes-cotizacion-rapida');
            } elseif ($size_2) {
                Session::put('color_2', $value);
                Session::forget('color_3');
                Session::forget('color_4');
                Session::forget('color_5');

                return redirect('sizes-cotizacion-rapida');
            } elseif ($size_1) {
                Session::put('color_1', $value);
                Session::forget('color_2');
                Session::forget('color_3');
                Session::forget('color_4');
                Session::forget('color_5');

                return redirect('sizes-cotizacion-rapida');
            } else {
                echo "something went wrong!";
            }
        } elseif ($request->has('finish')) {
            $value = $request->input('color');
            $size_1 = Session::has('size_1');
            $size_2 = Session::has('size_2');
            $size_3 = Session::has('size_3');
            $size_4 = Session::has('size_4');
            $size_5 = Session::has('size_5');

            if ($size_5) {
                Session::put('color_5', $value);

                return redirect('cotizacion-rapida');
            } elseif ($size_4) {
                Session::put('color_4', $value);
                Session::forget('color_5');

                return redirect('cotizacion-rapida');
            } elseif ($size_3) {
                Session::put('color_3', $value);
                Session::forget('color_4');
                Session::forget('color_5');

                return redirect('cotizacion-rapida');
            } elseif ($size_2) {
                Session::put('color_2', $value);
                Session::forget('color_3');
                Session::forget('color_4');
                Session::forget('color_5');

                return redirect('cotizacion-rapida');
            } elseif ($size_1) {
                Session::put('color_1', $value);
                Session::forget('color_2');
                Session::forget('color_3');
                Session::forget('color_4');
                Session::forget('color_5');

                return redirect('cotizacion-rapida');
            } else {
                echo "something went wrong!";
            }
        } else {
            echo "something went wrong!";
        }
    }

    public function getCotizacion()
    {
        $revelado_carta = 65;
        $revelado_media_carta = 30;
        $revelado_escudo = 20;
        $revelado_doble_carta = 100;
        $costo_color_1 = 10;
        $costo_color_2 = 12;
        $costo_color_3 = 7;
        $costo_color_4 = 5.5;
        $costo_color_5 = 5;
        $costo_color_6 = 4.5;
        $color_extra_carta_2 = 3.5;
        $color_extra_carta_3 = 1.5;
        $color_extra_carta_4 = 1;
        $color_extra_carta_5 = .8;
        $color_extra_carta_6 = .6;
        $color_extra_doble_carta_2 = 4;
        $color_extra_doble_carta_3 = 2.5;
        $color_extra_doble_carta_4 = 2;
        $color_extra_doble_carta_5 = 1.8;
        $color_extra_doble_carta_6 = 1.6;
        $color_extra_media_carta_2 = 3;
        $color_extra_media_carta_3 = 1.5;
        $color_extra_media_carta_4 = 1;
        $color_extra_media_carta_5 = .8;
        $color_extra_media_carta_6 = .6;
        $color_extra_escudo_2 = 3;
        $color_extra_escudo_3 = 1.5;
        $color_extra_escudo_4 = .7;
        $color_extra_escudo_5 = .5;
        $color_extra_escudo_6 = .5;

        if (Session::has('size_5')) {
            $size_1 = Session::get('size_1');
            $size_2 = Session::get('size_2');
            $size_3 = Session::get('size_3');
            $size_4 = Session::get('size_4');
            $size_5 = Session::get('size_5');
            $sizes = array(
                'size_1' => $size_1,
                'size_2' => $size_2,
                'size_3' => $size_3,
                'size_4' => $size_4,
                'size_5' => $size_5,
                );
        } elseif (Session::has('size_4')) {
            $size_1 = Session::get('size_1');
            $size_2 = Session::get('size_2');
            $size_3 = Session::get('size_3');
            $size_4 = Session::get('size_4');

            $sizes = array(
                'size_1' => $size_1,
                'size_2' => $size_2,
                'size_3' => $size_3,
                'size_4' => $size_4,
                );
        } elseif (Session::has('size_3')) {
            $size_1 = Session::get('size_1');
            $size_2 = Session::get('size_2');
            $size_3 = Session::get('size_3');
            $sizes = array(
                'size_1' => $size_1,
                'size_2' => $size_2,
                'size_3' => $size_3,
                );
        } elseif (Session::has('size_2')) {
            $size_1 = Session::get('size_1');
            $size_2 = Session::get('size_2');
            $sizes = array(
                'size_1' => $size_1,
                'size_2' => $size_2,
                );
        } elseif (Session::has('size_1')) {
            $size_1 = Session::get('size_1');
            $sizes = array(
                'size_1' => $size_1,
                );
        }

        $precio_1 = 0;
        $precio_2 = 0;
        $precio_3 = 0;
        $precio_4 = 0;
        $precio_5 = 0;
        $precio_6 = 0;
        $revelado = 0;

        $i = 1;
        foreach ($sizes as $size) {
            $color = Session::get('color_'.$i);

            if ($size === "Carta" || $size === "Perzonalizado-Carta") {
                $revelado_calculo = $revelado_carta;

                if ($color === "Multicolor") {
                    $color = 4;
                } elseif ($color === "Multicolor_color") {
                    $color = 5;
                }

                $precio_1_calculo = $costo_color_1;
                $precio_2_calculo = ($color_extra_carta_2*($color-1))+$costo_color_2;
                $precio_3_calculo = ($color_extra_carta_3*($color-1))+$costo_color_3;
                $precio_4_calculo = ($color_extra_carta_4*($color-1))+$costo_color_4;
                $precio_5_calculo = ($color_extra_carta_5*($color-1))+$costo_color_5;
                $precio_6_calculo = ($color_extra_carta_6*($color-1))+$costo_color_6;
            } elseif ($size === "Doble-Carta" || $size === "Perzonalizado-Doble-Carta") {
                $revelado_calculo = $revelado_doble_carta;

                if ($color === "Multicolor") {
                    $color = 4;
                } elseif ($color === "Multicolor_color") {
                    $color = 5;
                }

                $precio_1_calculo = $costo_color_1+1;
                $precio_2_calculo = ($color_extra_doble_carta_2*($color-1))+$costo_color_2+1;
                $precio_3_calculo = ($color_extra_doble_carta_3*($color-1))+$costo_color_3+1;
                $precio_4_calculo = ($color_extra_doble_carta_4*($color-1))+$costo_color_4+1;
                $precio_5_calculo = ($color_extra_doble_carta_5*($color-1))+$costo_color_5+1;
                $precio_6_calculo = ($color_extra_doble_carta_6*($color-1))+$costo_color_6+1;
            } elseif ($size === "Media-Carta" || $size === "Perzonalizado-Media-Carta") {
                $revelado_calculo = $revelado_media_carta;

                if ($color === "Multicolor") {
                    $color = 4;
                } elseif ($color === "Multicolor_color") {
                    $color = 5;
                }

                $precio_1_calculo = $costo_color_1-.50;
                $precio_2_calculo = ($color_extra_media_carta_2*($color-1))+$costo_color_2-.50;
                $precio_3_calculo = ($color_extra_media_carta_3*($color-1))+$costo_color_3-.50;
                $precio_4_calculo = ($color_extra_media_carta_4*($color-1))+$costo_color_4-.50;
                $precio_5_calculo = ($color_extra_media_carta_5*($color-1))+$costo_color_5-.50;
                $precio_6_calculo = ($color_extra_media_carta_6*($color-1))+$costo_color_6-.50;
            } elseif ($size === "Escudo" || $size === "Perzonalizado-Escudo") {
                $revelado_calculo = $revelado_escudo;

                if ($color === "Multicolor") {
                    $color = 4;
                } elseif ($color === "Multicolor_color") {
                    $color = 5;
                }

                $precio_1_calculo = $costo_color_1-1;
                $precio_2_calculo = ($color_extra_escudo_2*($color-1))+$costo_color_2-1;
                $precio_3_calculo = ($color_extra_escudo_3*($color-1))+$costo_color_3-1;
                $precio_4_calculo = ($color_extra_escudo_4*($color-1))+$costo_color_4-1;
                $precio_5_calculo = ($color_extra_escudo_5*($color-1))+$costo_color_5-1;
                $precio_6_calculo = ($color_extra_escudo_6*($color-1))+$costo_color_6-1;
            }

            $precio_1 += $precio_1_calculo;
            $precio_2 += $precio_2_calculo;
            $precio_3 += $precio_3_calculo;
            $precio_4 += $precio_4_calculo;
            $precio_5 += $precio_5_calculo;
            $precio_6 += $precio_6_calculo;
            $revelado += $revelado_calculo;
            $i++;
        }

        if ($i == 2) {
            $segunda_impresion = 0;
        } elseif ($i == 3) {
            $segunda_impresion = 1;
        } elseif ($i == 4) {
            $segunda_impresion = 2;
        } elseif ($i == 5) {
            $segunda_impresion = 3;
        } elseif ($i == 6) {
            $segunda_impresion = 4;
        } else {
            $segunda_impresion = 0;
        }

        return view('cotizacion.cotizacion', array(
            'link'        => 'Paso 5',
            'sizes'        =>    $sizes,
            'precio_1'    =>    $precio_1,
            'precio_2'    =>    $precio_2,
            'precio_3'    =>    $precio_3,
            'precio_4'    =>    $precio_4,
            'precio_5'    =>    $precio_5,
            'precio_6'    =>    $precio_6,
            'revelado'    =>    $revelado,
            'segunda_impresion'    =>    $segunda_impresion,
            ));

        // $array= array_merge($sizes, $colors);
        // print_r($array);
    }

}
