@extends('layouts.app')

@section('title', 'Inscrição Socioeconômico')
@section('content')
@push('scripts')

@endpush

{{ Form::open(['url' => route('minhaconta.socioeconomico.salvar'), 'method' => 'post']) }}


    <h3 class="form-section">Dados Pessoais</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Nome da mãe: <span class="required">*</span></label>
                <input type="text" class="form-control" name="nome_mae" value="{{old('nome_mae')}}" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Nome da pai: </label>
                <input type="text" class="form-control" name="nome_pai" value="{{old('nome_pai')}}">
            </div>
        </div>
    </div>
    <h3 class="form-section">Questionário de Avaliação</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="note note-warning">
                <b>ATENÇÃO:</b> Antes de responder à <b>questão n&ordm; 01</b>, preencha, obrigatoriamente, o quadro (Renda per capta), <a href="" target="_blank"><u><b><a href="{{asset('arquivos/quadro_renda_per_capta.xlt')}}">clicando aqui</a></b></u></a> e, só então, selecione a opção que se referir à sua situação. Este quadro deverá ser remetido para a COTEC, juntamente com as respostas do Questionário de Avaliação e a documentação comprobatória.
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>01 - Renda familiar per capta <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Zero a 234,00
                        <input type="radio" @if(old('questao1') == '1') checked @endif required value="1" name="questao1">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">235,00 a 468,00
                        <input type="radio" @if(old('questao1') == '2') checked @endif required value="2" name="questao1">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">469,00 a 937,00
                        <input type="radio" @if(old('questao1') == '3') checked @endif required value="3" name="questao1">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Mais de 937,00
                        <input type="radio" @if(old('questao1') == '4') checked @endif required value="4" name="questao1">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>02 - Escola em que cursou o Ensino Médio: <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Escola pública
                        <input type="radio" @if(old('questao2') == '1') checked @endif required value="1" name="questao2">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Escola particular, com pagamento integral
                        <input type="radio" @if(old('questao2') == '2') checked @endif required value="2" name="questao2">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Escola particular, com bolsa parcial (mínimo de 50%)
                        <input type="radio" @if(old('questao2') == '3') checked @endif required value="3" name="questao2">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Escola particular, com bolsa integral
                        <input type="radio" @if(old('questao2') == '4') checked @endif required value="4" name="questao2">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Parte em escola particular, com bolsa parcial e parte em escola pública
                        <input type="radio" @if(old('questao2') == '5') checked @endif required value="5" name="questao2">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Parte em escola pública, parte em escola particular
                        <input type="radio" @if(old('questao2') == '6') checked @endif required value="6" name="questao2">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>03 - Escola em que fez integralmente o ensino fundamental: <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Escola pública
                        <input type="radio" @if(old('questao3') == '1') checked @endif required value="1" name="questao3">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Escola particular, com pagamento integral
                        <input type="radio" @if(old('questao3') == '2') checked @endif required value="2" name="questao3">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Escola particular, com bolsa parcial (mínimo de 50%)
                        <input type="radio" @if(old('questao3') == '3') checked @endif required value="3" name="questao3">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Escola particular, com bolsa integral
                        <input type="radio" @if(old('questao3') == '4') checked @endif required value="4" name="questao3">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Parte em escola particular, com bolsa parcial e parte em escola pública
                        <input type="radio" @if(old('questao3') == '5') checked @endif required value="5" name="questao3">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Parte em escola pública, parte em escola particular
                        <input type="radio" @if(old('questao3') == '6') checked @endif required value="6" name="questao3">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>04 - Escola/instituição em que fez ou está fazendo cursinho pré-vestibular: <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Instituição pública
                        <input type="radio" @if(old('questao4') == '1') checked @endif required value="1" name="questao4">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Escola particular, com pagamento integral
                        <input type="radio" @if(old('questao4') == '2') checked @endif required value="2" name="questao4">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Escola particular, com bolsa parcial (mínimo de 50%)
                        <input type="radio" @if(old('questao4') == '3') checked @endif required value="3" name="questao4">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Escola particular, com bolsa integral
                        <input type="radio" @if(old('questao4') == '4') checked @endif required value="4" name="questao4">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Não fez cursinho
                        <input type="radio" @if(old('questao4') == '5') checked @endif required value="5" name="questao4">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>05 - O candidato ou algum membro da família participa
de programa social do governo federal? <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Bolsa Família
                        <input type="radio" @if(old('questao5') == '1') checked @endif required value="1" name="questao5">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Passe Livre para transportes coletivos interestaduais para deficientes carentes
                        <input type="radio" @if(old('questao5') == '2') checked @endif required value="2" name="questao5">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Benefício de prestação continuada (BPC)
                        <input type="radio" @if(old('questao5') == '3') checked @endif required value="3" name="questao5">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Não participa de programas sociais
                        <input type="radio" @if(old('questao5') == '4') checked @endif required value="4" name="questao5">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>06 - Situação civil do candidato: <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Solteiro(a)
                        <input type="radio" @if(old('questao6') == '1') checked @endif required value="1" name="questao6">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Casado(a)
                        <input type="radio" @if(old('questao6') == '2') checked @endif required value="2" name="questao6">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Separado(a)(separação legalizada ou não)/Divorciado
                        <input type="radio" @if(old('questao6') == '3') checked @endif required value="3" name="questao6">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Viúvo(a)
                        <input type="radio" @if(old('questao6') == '4') checked @endif required value="4" name="questao6">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">União estável
                        <input type="radio" @if(old('questao6') == '5') checked @endif required value="5" name="questao6">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>07- Se o candidato é solteiro e não mora com a família: <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Não se aplica
                        <input type="radio" @if(old('questao7') == '0') checked @endif required value="0" name="questao7">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Mora sozinho, em imóvel próprio
                        <input type="radio" @if(old('questao7') == '1') checked @endif required value="1" name="questao7">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Mora sozinho, em imóvel alugado
                        <input type="radio" @if(old('questao7') == '2') checked @endif required value="2" name="questao7">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Mora em república/pensão
                        <input type="radio" @if(old('questao7') == '3') checked @endif required value="3" name="questao7">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Mora com parentes ou conhecidos
                        <input type="radio" @if(old('questao7') == '4') checked @endif required value="4" name="questao7">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>08 - Situação da casa em que reside o grupo familiar: <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Alugada
                        <input type="radio" @if(old('questao8') == '1') checked @endif required value="1" name="questao8">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Própria (ainda em pagamento)
                        <input type="radio" @if(old('questao8') == '2') checked @endif required value="2" name="questao8">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Própria (já paga/herdada)
                        <input type="radio" @if(old('questao8') == '3') checked @endif required value="3" name="questao8">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Cedida por familiares/terceiros
                        <input type="radio" @if(old('questao8') == '4') checked @endif required value="4" name="questao8">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>09 - Além do próprio candidato, quantos membros
do grupo familiar vão se inscrever no
programa socioecon&ocirc;mico para concessão de desconto/isenção: <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Nenhum membro
                        <input type="radio" @if(old('questao9') == '1') checked @endif required value="1" name="questao9">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">01 membro
                        <input type="radio" @if(old('questao9') == '2') checked @endif required value="2" name="questao9">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">02 ou mais membros
                        <input type="radio" @if(old('questao9') == '3') checked @endif required value="3" name="questao9">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>10 - O candidato ou membro do
grupo familiar utiliza medicamento de uso contínuo? <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Sim
                        <input type="radio" @if(old('questao10') == '1') checked @endif required value="1" name="questao10">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Não
                        <input type="radio" @if(old('questao10') == '2') checked @endif required value="2" name="questao10">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>11 - Participa do programa de
tarifa social da COPASA? <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Sim
                        <input type="radio" @if(old('questao11') == '1') checked @endif required value="1" name="questao11">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Não
                        <input type="radio" @if(old('questao11') == '2') checked @endif required value="2" name="questao11">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><strong>12 - Participa do programa de tarifa social da CEMIG? <span class="required">*</span></strong></label>
                <div class="mt-radio-list">
                    <label class="mt-radio mt-radio-outline">Sim
                        <input type="radio" @if(old('questao12') == '1') checked @endif required value="1" name="questao12">
                        <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">Não
                        <input type="radio" @if(old('questao12') == '2') checked @endif required value="2" name="questao12">
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row margin-top-15">
        <div class="col-md-12">
            <div class="note note-info">
                <h4 class="block"><strong>Nota:</strong></h4>
                <p> Com o preenchimento da Ficha de Socioeconômico, o candidato declara: </p>
                <p>a) estar ciente e aceitar as normas constantes no Edital.</p>
                <p>b) o preenchimento desta ficha e as informações prestadas são de inteira responsabilidade do(a) candidato(a) .</p>
                <p>c) estar ciente de que não serão permitidas alterações posteriores.</p>
                <p>d) a falta de veracidade implicará o cancelamento da sua inscrição.</p>
            </div>
        </div>
        <div class="col-md-12">
            <label class="mt-checkbox mt-checkbox-outline">
                <input type="checkbox" required> Declaro atender as condições exigidas para inscrição, conhecer o Edital do Processo e concordo com o mesmo.
                <span></span>
            </label>
        </div>
    </div>

    <button type="submit" class="btn bg-green-jungle bg-font-green-jungle">Enviar</button>

{{ Form::close() }}
</div>

@endsection
