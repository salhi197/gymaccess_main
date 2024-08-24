<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Membre;
use App\Item;
use App\Setting;

class Template extends Model
{

    public static  function bl($commande)
    {
        $total = 0;
        $total = 0;
        $items = Item::where('commande',$commande->id)->get();

        $html = '        
            <!doctype html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <title>Bon </title>
            
            <style type="text/css">
                * {
                    font-family: Verdana, Arial, sans-serif;
                }
                table{
                    font-size: x-small;
                }
                tfoot tr td{
                    font-weight: bold;
                    font-size: x-small;
                }
                .gray {
                    background-color: white lightgray
                }
                .item{
                    text-align:center;
                }
            </style>
            
            </head>
            <body>
            
            <table width="100%">
                <tr>
                    <td align="left">
                        <h3>'.Setting::getSetting('titre').'</h3>
                        <pre>
                        </pre>
                    </td>
                    <td align="">
                    </td>

                </tr>
            
            </table>
            
            <table width="100%">
                <tr>
                    <td><strong>Saisie Par :</strong>'.$commande->user()['name'].'</td>
                    <td><strong>Crée Le: '.$commande->created_at.'</strong></td>
                    <td><strong>Le:</strong> '.date('d-m-Y').'</td>
                </tr>
            
            </table>
            
            <br/>
            
            <table width="100%">
                <thead style="background-color: lightgray;">
                <tr>
                    <th style="cursor:pointer;">Nom Produit</th>
                    <th style="cursor:pointer;">Quantité </th>
                    <th style="cursor:pointer;">Prix Unitaire </th>
                    <th style="cursor:pointer;">Total </th>
                </tr>
                </thead>
                <tbody>
                    ';
                    foreach($items as $item){
                        $produit = Produit::find($item->produit);
                        $html = $html.'<tr>';
                        $html = $html.'<td class="item">'.$produit->nom.'</td>';
                        $html = $html.'<td class="item">'.$item->qte.'</td>';
                        $html = $html.'<td class="item">'.$item->prix.' DA</td>';
                        $html = $html.'<td class="item">'.$item->prix*$item->qte.' DA</td>';
                        $html = $html.'</tr>';
                        $total = $total + $item->prix*$item->qte;
                    }
                                                               
                $html=$html.'                
                </tbody>
            
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td align="center">Total TTC</td>
                        <td align="right" >'.$total.' DA</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td align="center">Remise</td>
                        <td align="right" >'.intval($commande->remise ?? 0).' DA</td>
                    </tr>

                    <tr>
                        <td colspan="2"></td>
                        <td align="center">Net à payer</td>
                        <td align="right" >'.intval($total-$commande->remise).' DA</td>
                    </tr>

                </tfoot>
            </table>
            
            </body>
            </html>        
        
        ';
        return $html;   
    }

    public static function Bulletin($versement)
    {

        $membre = Membre::find($versement->membre);
        $inscription = Inscription::find($versement->inscription);
        $path=asset('img/bon.pdf');
        $html='
            <html>
            <head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
            <style type="text/css">
            <!--
            span.cls_002{font-family:"Calibri Bold",serif;font-size:14.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            div.cls_002{font-family:"Calibri Bold",serif;font-size:14.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            span.cls_003{font-family:"Calibri Bold",serif;font-size:11.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            div.cls_003{font-family:"Calibri Bold",serif;font-size:11.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            span.cls_004{font-family:"Calibri",serif;font-size:11.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
            div.cls_004{font-family:"Calibri",serif;font-size:11.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
            span.cls_019{font-family:Times,serif;font-size:20.0px;color:rgb(0,0,0);font-weight:bold;font-style:italic;text-decoration: underline}
            div.cls_019{font-family:Times,serif;font-size:20.0px;color:rgb(0,0,0);font-weight:bold;font-style:italic;text-decoration: none}
            span.cls_006{font-family:Arial,serif;font-size:11.6px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            div.cls_006{font-family:Arial,serif;font-size:11.6px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            span.cls_007{font-family:Arial,serif;font-size:11.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            div.cls_007{font-family:Arial,serif;font-size:11.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            span.cls_008{font-family:Arial,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            div.cls_008{font-family:Arial,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            span.cls_009{font-family:Arial,serif;font-size:10.6px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            div.cls_009{font-family:Arial,serif;font-size:10.6px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            span.cls_010{font-family:Arial,serif;font-size:12.5px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            div.cls_010{font-family:Arial,serif;font-size:12.5px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            span.cls_011{font-family:Arial,serif;font-size:9.5px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            div.cls_011{font-family:Arial,serif;font-size:9.5px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            span.cls_020{font-family:Times,serif;font-size:14.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: underline}
            div.cls_020{font-family:Times,serif;font-size:14.0px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
            span.cls_015{font-family:Arial,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
            div.cls_015{font-family:Arial,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
            span.cls_016{font-family:Arial,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
            div.cls_016{font-family:Arial,serif;font-size:22.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
            -->
            </style>
            <script type="text/javascript" src="d5960adc-7dfb-11eb-8b25-0cc47a792c0a_id_d5960adc-7dfb-11eb-8b25-0cc47a792c0a_files/wz_jsgraphics.js"></script>
            </head>
            <body>
            <div style="position:absolute;left:50%;margin-left:-297px;top:0px;width:595px;height:841px;overflow:hidden">
            <div style="position:absolute;left:0px;top:0px">
            </div>
            <div style="position:absolute;left:50px;top:33.82px" class="cls_001"><span class="cls_001">'.Setting::getSetting('titre').'</span></div>
            <div style="position:absolute;left:50px;top:61.10px" class="cls_001"><span class="cls_001">Téléphone : </span><span class="cls_001"> '.Setting::getSetting('telephone').' </span></div>
            <div style="position:absolute;left:50px;top:80.48px" class="cls_001"><span class="cls_001">Email : </span><span class="cls_001"> '.Setting::getSetting('email').' </span></div>
            <div style="position:absolute;left:50px;top:100.92px" class="cls_001"><span class="cls_001">Adresse : </span><span class="cls_001">'.Setting::getSetting('adress').'  </span></div>
            <div style="position:absolute;left:420.28px;top:117.86px" class="cls_001"><span class="cls_001">Alger Le  :'.date('Y-m-d').'</span></div>
            <div style="position:absolute;left:220.56px;top:135.54px" class="cls_019"><span class="cls_019">Bon De Versement </span></div>
            <div style="position:absolute;left:30.00px;top:201.78px" class="cls_001"><span class="cls_001">Numéro dinscription :  '.$inscription->id.'</span><span class="cls_007"> </span><span class="cls_008"> </span></div>
            <div style="position:absolute;left:30.00px;top:224.64px" class="cls_001"><span class="cls_001">Membre </span><span class="cls_001">: '.$membre->nom.' '.$membre->prenom.'</span></div>
            <div style="position:absolute;left:30.00px;top:247.56px" class="cls_001"><span class="cls_001">Montant :'.$versement->montant.' DA</span></div>
            <div style="position:absolute;left:30.00px;top:269.82px" class="cls_001"><span class="cls_001">Date de versement </span><span class="cls_001"> </span><span class="cls_010"> </span><span class="cls_010">:'.$versement->date_versement  .'</span></div>
            
            </body>
            </html>        
        ';
        return $html;

    }
    /**
     * 
     */
    public static function Facture($facture)
    {
        $items = Item::where('facture',$facture->id)->get();

        $html='
        <!doctype html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Facture</title>
        
        <style type="text/css">
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            table{
                font-size: x-small;
            }
            tfoot tr td{
                font-weight: bold;
                font-size: x-small;
            }
        
            .gray {
                background-color: lightgray
            }
        </style>
        
        </head>
        <body>
        
          <table width="100%">
            <tr>
                <td valign="top"><img src="" alt="" width="150"/></td>
                <td align="right">
                    <h3>Laboratoire des analyses</h3>
                    <pre>
                        Company representative name
                        Company address
                        Tax ID
                        phone
                        fax
                    </pre>
                </td>

            </tr>
        
          </table>
        
          <table width="100%">
            <tr>
                <td><strong>Client:</strong>  </td>
            </tr>
        
          </table>
        
          <br/>
        
          <table width="100%">
            <thead style="background-color: lightgray;">
              <tr>
                <th>#</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Pix </th>
                <th>Total </th>
              </tr>
            </thead>
            <tbody>
            ';
            foreach($items as $item){
                $html = $html .'
                    <tr>
                        <th scope="row">'.$item->id.'</th>
                        <td>'.$item->designation.'</td>
                        <td align="center">'.$item->quantite.'</td>
                        <td align="center">'.$item->prix.'</td>
                        <td align="center">'.$item->prix*$item->quantite.'</td>
                    </tr>                
                ';
            }

            $tva =$facture->total * 0.19;
            $ttc = $tva +$facture->total;
            $html= $html .'
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td align="center">Total </td>
                    <td align="center">'.$facture->total.'</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td align="center">TVA</td>
                    <td align="center">'.$tva.'</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td align="center">Total TTc </td>
                    <td align="center" >'.$ttc.'</td>
                </tr>
            </tfoot>
          </table>
        </body>
        </html>        
        
        ';

        return $html;

    }




}
