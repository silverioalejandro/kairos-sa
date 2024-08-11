<?php

namespace Tests\Mocks;

use Mockery;
use Illuminate\Support\Facades\App;
use App\Models\CampaignItemJobResult;
use App\Services\CollectionCampaign\CampaignStatesStrategies\StateInQueryCasarsa;

class GetCasarsaMockBuilder
{
    private $service;
    private $app;

    private function __construct()
    {
        $this->service = Mockery::mock(StateInQueryCasarsa::class);
        $this->app = App::getFacadeRoot();
    }

    public static function create()
    {
        return new GetCasarsaMockBuilder();
    }

    public function build()
    {
        $this->app->instance(StateInQueryCasarsa::class, $this->service);
    }

    public function withDataOk()
    {
        CampaignItemJobResult::create([
            'result' => $this->data(),
            'collection_campaign_id' => 1
        ]);

        // $this->service->shouldReceive('executeJob')->andReturn(
        //     '---'
        // );

        return $this;
    }

    public function data()
    {
        return '[{"loan": {"capital": 10500, "cre_tipo": "CP  ", "reversals": [], "cre_numero": 108037, "dias_atraso": 0, "cuenta_socio": 49731, "id_alternativo": 34560, "saldo_pendiente": 15981.36, "tiene_reversiones": false}, "saldo": 3995.34, "capital": 2625, "cre_tipo": "CP  ", "publisher": {"aso_codigo": 49731, "aso_nombre": "Sanchez Yamila Soledad", "aso_documento": "27380654704"}, "cod_linea": 1000, "nom_linea": "ANTICIPO 1000", "nro_cuota": 1, "cre_estado": "MOR ", "cre_numero": 108037, "org_nombre": "COIN ROMACHI", "vencimiento": "2021-11-30", "cuenta_socio": 49731, "cantidad_ctas": 4}, {"loan": {"capital": 4500, "cre_tipo": "CP  ", "reversals": [], "cre_numero": 96126, "dias_atraso": 0, "cuenta_socio": 42978, "id_alternativo": 26026, "saldo_pendiente": 3508.01, "tiene_reversiones": false}, "saldo": 1507.75, "capital": 1125, "cre_tipo": "CP  ", "publisher": {"aso_codigo": 42978, "aso_nombre": "REINA MARCELO JORGE", "aso_documento": "23233640549"}, "cod_linea": 105, "nom_linea": "ANTICIPO 105", "nro_cuota": 3, "cre_estado": "MOR ", "cre_numero": 96126, "org_nombre": "COIN ROMACHI", "vencimiento": "2021-11-30", "cuenta_socio": 42978, "cantidad_ctas": 4}, {"loan": {"capital": 3000, "cre_tipo": "CP  ", "reversals": [], "cre_numero": 98776, "dias_atraso": 0, "cuenta_socio": 45070, "id_alternativo": 27881, "saldo_pendiente": 3816.57, "tiene_reversiones": false}, "saldo": 1037.15, "capital": 750, "cre_tipo": "CP  ", "publisher": {"aso_codigo": 45070, "aso_nombre": "Manquillan Javier", "aso_documento": "20229474902"}, "cod_linea": 18, "nom_linea": "ANTICIPO", "nro_cuota": 2, "cre_estado": "MOR ", "cre_numero": 98776, "org_nombre": "COIN ROMACHI", "vencimiento": "2021-11-30", "cuenta_socio": 45070, "cantidad_ctas": 4}, {"loan": {"capital": 4500, "cre_tipo": "CP  ", "reversals": [], "cre_numero": 92298, "dias_atraso": 0, "cuenta_socio": 40405, "id_alternativo": 23814, "saldo_pendiente": 996.27, "tiene_reversiones": false}, "saldo": 996.27, "capital": 1125, "cre_tipo": "CP  ", "publisher": {"aso_codigo": 40405, "aso_nombre": "LOPEZ CANDY ABIGAIL", "aso_documento": "27417361435"}, "cod_linea": 106, "nom_linea": "ANTICIPO 106", "nro_cuota": 4, "cre_estado": "MOR ", "cre_numero": 92298, "org_nombre": "COIN ROMACHI", "vencimiento": "2021-11-30", "cuenta_socio": 40405, "cantidad_ctas": 4}, {"loan": {"capital": 9000, "cre_tipo": "CP  ", "reversals": [], "cre_numero": 107208, "dias_atraso": 0, "cuenta_socio": 49147, "id_alternativo": 33645, "saldo_pendiente": 13696, "tiene_reversiones": false}, "saldo": 3424, "capital": 2250, "cre_tipo": "CP  ", "publisher": {"aso_codigo": 49147, "aso_nombre": "Herrera Mayra", "aso_documento": "27380322760"}, "cod_linea": 1000, "nom_linea": "ANTICIPO 1000", "nro_cuota": 1, "cre_estado": "MOR ", "cre_numero": 107208, "org_nombre": "COIN ROMACHI", "vencimiento": "2021-11-30", "cuenta_socio": 49147, "cantidad_ctas": 4}, {"loan": {"capital": 4500, "cre_tipo": "CP  ", "reversals": [], "cre_numero": 107322, "dias_atraso": 0, "cuenta_socio": 49247, "id_alternativo": 33483, "saldo_pendiente": 4395.76, "tiene_reversiones": false}, "saldo": 597.01, "capital": 1125, "cre_tipo": "CP  ", "publisher": {"aso_codigo": 49247, "aso_nombre": "CORTEZ SEBASTIAN EDUARDO", "aso_documento": "23365563799"}, "cod_linea": 106, "nom_linea": "ANTICIPO 106", "nro_cuota": 1, "cre_estado": "MOR ", "cre_numero": 107322, "org_nombre": "COIN ROMACHI", "vencimiento": "2021-11-30", "cuenta_socio": 49247, "cantidad_ctas": 4}, {"loan": {"capital": 4500, "cre_tipo": "CP  ", "reversals": [], "cre_numero": 92021, "dias_atraso": 0, "cuenta_socio": 40169, "id_alternativo": 23450, "saldo_pendiente": 83.73, "tiene_reversiones": false}, "saldo": 83.73, "capital": 1125, "cre_tipo": "CP  ", "publisher": {"aso_codigo": 40169, "aso_nombre": "PEREIRA DIAZ MATIAS ADAN", "aso_documento": "20346571064"}, "cod_linea": 106, "nom_linea": "ANTICIPO 106", "nro_cuota": 4, "cre_estado": "MOR ", "cre_numero": 92021, "org_nombre": "COIN ROMACHI", "vencimiento": "2021-11-30", "cuenta_socio": 40169, "cantidad_ctas": 4}, {"loan": {"capital": 12000, "cre_tipo": "CP  ", "reversals": [], "cre_numero": 107287, "dias_atraso": 0, "cuenta_socio": 49218, "id_alternativo": 33536, "saldo_pendiente": 18269.36, "tiene_reversiones": false}, "saldo": 4567.34, "capital": 3000, "cre_tipo": "CP  ", "publisher": {"aso_codigo": 49218, "aso_nombre": "SILVA ALEJANDRO MARCELO", "aso_documento": "20352049566"}, "cod_linea": 1000, "nom_linea": "ANTICIPO 1000", "nro_cuota": 1, "cre_estado": "MOR ", "cre_numero": 107287, "org_nombre": "COIN ROMACHI", "vencimiento": "2021-11-30", "cuenta_socio": 49218, "cantidad_ctas": 4}, {"loan": {"capital": 4500, "cre_tipo": "CP  ", "reversals": [], "cre_numero": 100438, "dias_atraso": 0, "cuenta_socio": 46097, "id_alternativo": 29177, "saldo_pendiente": 3798.75, "tiene_reversiones": false}, "saldo": 1266.25, "capital": 1125, "cre_tipo": "CP  ", "publisher": {"aso_codigo": 46097, "aso_nombre": "Iturri Daniel", "aso_documento": "20345607634"}, "cod_linea": 106, "nom_linea": "ANTICIPO 106", "nro_cuota": 2, "cre_estado": "MOR ", "cre_numero": 100438, "org_nombre": "COIN ROMACHI", "vencimiento": "2021-11-30", "cuenta_socio": 46097, "cantidad_ctas": 4}, {"loan": {"capital": 545, "cre_tipo": "CS  ", "reversals": [], "cre_numero": 113395, "dias_atraso": 0, "cuenta_socio": 46097, "id_alternativo": 29177, "saldo_pendiente": 1091.7, "tiene_reversiones": false}, "saldo": 1.7, "capital": 136.25, "cre_tipo": "CS  ", "publisher": {"aso_codigo": 46097, "aso_nombre": "Iturri Daniel", "aso_documento": "20345607634"}, "cod_linea": 9001, "nom_linea": "MEMBRESIA", "nro_cuota": 2, "cre_estado": "ACT ", "cre_numero": 113395, "org_nombre": "COIN ROMACHI", "vencimiento": "2021-11-30", "cuenta_socio": 46097, "cantidad_ctas": 4}]';
    }
}
