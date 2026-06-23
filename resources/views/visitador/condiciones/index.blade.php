@extends('layouts.app')

@section('navegador')
    @include('template.nav-visitador')
@endsection

@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <h2 class="contenido-bloques-titulo pt-4">Términos y Condiciones</h2>

            <div class="row d-flex justify-content-center">
                <div class="col-md-8 my-1">
                    <div class="mi-card mb-4">
                        <div class="mi-card-content py-3">
                            <h3 class="card-title">1. Introducción</h3>
                            <p class="text-justify">Bienvenido a <strong>PreuniCursos</strong> "Plataforma educativa diseñada
                                para ti". Al
                                suscribirse y
                                utilizar nuestros servicios,
                                usted acepta cumplir y estar sujeto a los siguientes términos y condiciones "Términos".
                                Estos Términos se aplican a todos los usuarios de la Plataforma, incluidos los estudiantes y
                                cualquier otra persona que acceda o utilice nuestros servicios.</p>
                        </div>
                    </div>

                    <div class="mi-card mb-4">
                        <div class="mi-card-content py-3">
                            <h3 class="card-title">2. Descripción de los Servicios</h3>
                            <p class="text-justify">La Plataforma ofrece cursos educativos en diversas materias como
                                matemáticas, física,
                                química, ciencias sociales, entre otros, dirigidos a jóvenes escolares y preuniversitarios.
                                Los servicios incluyen:</p>
                            <ol class="mt-3">
                                <li>
                                    <div class="d-flex">
                                        <i class='bx bx-check-circle' style='color: #1a1f71;margin-top:3px'></i>
                                        <span>Videos educativos (alojados en YouTube).</span>
                                    </div>
                                </li>

                                <li>
                                    <div class="d-flex">
                                        <i class='bx bx-check-circle' style='color: #1a1f71;margin-top:3px'></i>
                                        <span>Archivos PDF con material de estudio.</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class='bx bx-check-circle' style='color: #1a1f71;margin-top:3px'></i>
                                        <span>Compendios académicos descargables.</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class='bx bx-check-circle' style='color: #1a1f71;margin-top:3px'></i>
                                        <span>Sistema de preguntas para repaso.</span>
                                    </div>
                                </li>
                            </ol>
                            <h4 class="mt-3">Planes de Suscripción(sujeto a cambios):</h4>
                            <ol class="mt-3">
                                <li>
                                    <div class="d-flex">
                                        <i class='bx bx-user-check' style='color: #1a1f71;margin-top:3px'></i>
                                        <span><strong>Mensual</strong>: S/ 25.00 al mes.</span>
                                    </div>
                                </li>
                                 <li>
                                    <div class="d-flex">
                                        <i class='bx bx-user-check' style='color: #1a1f71;margin-top:3px'></i>
                                        <span><strong>Semestral</strong>: S/ 109.00 al mes.</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class='bx bx-user-check' style='color: #1a1f71;margin-top:3px'></i>
                                        <span><strong>Anual</strong>: S/ 209.00 al mes.</span>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="mi-card mb-4">
                        <div class="mi-card-content py-3">
                            <h3 class="card-title">3. Registro y Cuentas</h3>
                            <p class="text-justify">Para acceder a nuestros servicios, siga los siguientes pasos:</p>

                            <ul class="mt-3">
                                <li>
                                    <div class="d-flex">
                                        <i class='bx bx-message-alt-check' style='color: #1a1f71;margin-top:3px'></i>
                                        <span><strong>Registro:</strong> Regístrese en la Plataforma utilizando un correo
                                            electrónico
                                            válido.</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <i class='bx bx-message-alt-check' style='color: #1a1f71;margin-top:3px'></i>
                                        <span><strong>Selección de Plan:</strong> Al registrarse, podrá seleccionar un plan
                                            que
                                            se ajuste a sus necesidades: </span>
                                    </div>
                                </li>
                            </ul>

                            <ol class="mt-3">
                                <ul>
                                    <li><strong>Plan Mensual : {{ env('PLAN_MENSUAL') }}</strong>
                                        <ul>
                                            <li>
                                                <div class="d-flex">
                                                    <i class='bx bx-badge-check' style='color: #1a1f71;margin-top:3px'></i>
                                                    <span>Acceso a todos los cursos.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <i class='bx bx-badge-check' style='color: #1a1f71;margin-top:3px'></i>
                                                    <span>Acceso a los compendios.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <i class='bx bx-badge-check' style='color: #1a1f71;margin-top:3px'></i>
                                                    <span>Acceso a los recursos descargables.</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="mt-2"><strong>Plan Semestral : {{ env('PLAN_SEIS_MES') }}</strong>
                                        <ul>
                                            <li>
                                                <div class="d-flex">
                                                    <i class='bx bxs-badge-check' style='color: #1a1f71;margin-top:3px'></i>
                                                    <span>Acceso a todos los cursos.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <i class='bx bxs-badge-check' style='color: #1a1f71;margin-top:3px'></i>
                                                    <span>Acceso a los compendios.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <i class='bx bxs-badge-check' style='color: #1a1f71;margin-top:3px'></i>
                                                    <span>Acceso a los recursos descargables.</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex">
                                                    <i class='bx bxs-badge-check' style='color: #1a1f71;margin-top:3px'></i>
                                                    <span>Acceso a lista de exámenes y resultados.</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </ol>
                            <p class="text-justify">Usted es responsable de mantener la confidencialidad de su información
                                de inicio de
                                sesión y de todas las actividades que ocurran bajo su cuenta. <strong>Se prohíbe compartir
                                    cuentas.</strong></p>
                        </div>
                    </div>


                    <div class="mi-card mb-4">
                        <div class="mi-card-content py-3">
                            <h3 class="card-title">4. Uso del Contenido</h3>
                            <p class="text-justify">Todo el contenido proporcionado en la Plataforma, incluidos los videos,
                                archivos PDF y
                                preguntas, es solo para uso educativo personal y está disponible las 24 horas del día para
                                el estudiante.</p>
                            <h4 class="mt-3">Material de Terceros</h4>
                            <ul class="mt-2">
                                <li class="text-justify"><strong>
                                        <div class="d-flex">
                                            <i class='bx bxs-flag-checkered' style='color: #1a1f71;margin-top:3px'></i>
                                            <span>Fuentes Externas:</span>
                                        </div>
                                    </strong> Los <strong>videos y archivos PDF disponibles en la
                                        Plataforma</strong> han sido obtenidos de <strong>fuentes externas como YouTube y
                                        otros sitios web</strong>. Cada
                                    documento y video está debidamente citado para reconocer a los autores originales.
                                </li>

                                <li class="mt-1 text-justify"><strong>
                                        <div class="d-flex">
                                            <i class='bx bxs-flag-checkered' style='color: #1a1f71;margin-top:3px'></i>
                                            <span>Responsabilidad de Uso:</span>
                                        </div>
                                    </strong> Es su responsabilidad asegurarse
                                    de que
                                    cualquier uso del contenido de terceros cumple con las políticas y términos de uso del
                                    proveedor original. No nos hacemos responsables por el uso indebido de materiales
                                    protegidos por derechos de autor por parte de los usuarios.
                                </li>

                                <li class="mt-1 text-justify"><strong>
                                        <div class="d-flex">
                                            <i class='bx bxs-flag-checkered' style='color: #1a1f71;margin-top:3px'></i>
                                            <span>Permisos:</span>
                                        </div>
                                    </strong> En caso de ser necesario, usted debe obtener
                                    los permisos
                                    adecuados de los titulares de los derechos de autor para cualquier uso que exceda el
                                    ámbito personal y educativo.
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="mi-card mb-4">
                        <div class="mi-card-content py-3">
                            <h3 class="card-title">5. Derechos de Propiedad Intelectual</h3>
                            <p class="text-justify">Todos los derechos de propiedad intelectual en la Plataforma y su
                                contenido (excepto el
                                contenido de terceros) son propiedad de PreuniCursos o sus licenciantes. No se otorgan
                                derechos de propiedad intelectual a usted, excepto los expresamente mencionados en estos
                                Términos.</p>
                            <p class="my-3"><strong>Esto incluye, pero no se limita a:</strong></p>
                            <ul>
                                <li class="mt-1 text-justify"><strong>
                                        <div class="d-flex">
                                            <i class='bx bxs-flag-checkered' style='color: #1a1f71;margin-top:3px'></i>
                                            <span>Diseño de la Plataforma:</span>
                                        </div>
                                    </strong> La apariencia y la experiencia de usuario de
                                    la Plataforma, incluyendo la disposición visual, los gráficos y la interfaz de usuario.
                                </li>
                                <li class="mt-1 text-justify"><strong>
                                        <div class="d-flex">
                                            <i class='bx bxs-flag-checkered' style='color: #1a1f71;margin-top:3px'></i>
                                            <span>Textos creados por PreuniCursos:</span>
                                        </div>
                                    </strong> Todo el contenido escrito y producido
                                    por PreuniCursos, como lecciones, guías y descripciones de cursos.</li>
                                <li class="mt-1 text-justify"><strong>
                                        <div class="d-flex">
                                            <i class='bx bxs-flag-checkered' style='color: #1a1f71;margin-top:3px'></i>
                                            <span>Imágenes y elementos gráficos:</span>
                                        </div>
                                    </strong> El logotipo y otros elementos visuales
                                    creados por PreuniCursos para identificar la marca y mejorar la experiencia del usuario.
                                </li>
                                <li class="mt-1 text-justify"><strong>
                                        <div class="d-flex">
                                            <i class='bx bxs-flag-checkered' style='color: #1a1f71;margin-top:3px'></i>
                                            <span>Códigos y software:</span>
                                        </div>
                                    </strong> Todos los programas informáticos y códigos
                                    desarrollados por PreuniCursos para el funcionamiento y la mejora continua de la
                                    Plataforma.
                                </li>
                            </ul>
                            <p class="text-justify">Por favor, tenga en cuenta que el uso o la reproducción no autorizados
                                de cualquiera de estos
                                elementos están estrictamente prohibidos y pueden estar sujetos a medidas legales.</p>
                        </div>
                    </div>


                    <div class="mi-card mb-4">
                        <div class="mi-card-content py-3">
                            <h3 class="card-title">6. Pagos y Facturación</h3>
                            <p class="text-justify">Las suscripciones <strong>se cobran mensualmente el día 2 de cada
                                    mes</strong>, comenzando
                                desde la fecha de
                                registro. Al suscribirse, usted acepta pagar las tarifas indicadas para el plan seleccionado
                                al momento de la suscripción.</p>
                            <p class="text-justify">Nos reservamos el derecho de cambiar las tarifas de suscripción en
                                cualquier momento, previo
                                aviso razonable. Sin embargo, cualquier cambio en las tarifas no afectará las suscripciones
                                activas hasta su próximo ciclo de facturación.</p>
                            <p class="mt-2 text-justify"><strong>Usted tiene la opción de cancelar su suscripción al plan
                                    en cualquier
                                    momento y hora
                                    a través
                                    de su cuenta en la Plataforma</strong>. Sin embargo, tenga en cuenta que <strong>no se
                                    otorgan reembolsos por
                                    meses parciales de servicio</strong>. La cancelación de su suscripción será efectiva al
                                finalizar el período de facturación actual.</p>
                            <p>Por favor, asegúrese de revisar regularmente su estado de cuenta y la fecha de vencimiento de
                                su suscripción para evitar interrupciones en el acceso a los servicios.</p>
                        </div>
                    </div>


                    <div class="mi-card mb-4">
                        <div class="mi-card-content py-3">
                            <h3 class="card-title">7. Cancelación y Reembolsos</h3>
                            <p class="text-justify">Usted puede cancelar su suscripción en cualquier momento a través de su
                                cuenta en la
                                Plataforma. Sin embargo, es importante tener en cuenta que al cancelar su suscripción,
                                perderá inmediatamente el acceso a todos los cursos, materiales y recursos disponibles en la
                                plataforma. <strong>La cancelación de la suscripción se hace efectiva de inmediato, y usted
                                    dejará de tener los beneficios asociados con su plan de suscripción.</strong></p>
                            <p class="mt-2 text-justify">Dado que la cancelación de la suscripción resulta en la pérdida
                                inmediata de
                                acceso a los
                                servicios, <strong>no se otorgan reembolsos por el tiempo no utilizado dentro del ciclo de
                                    facturación actual.</strong></p>
                            <p class="text-justify">Por lo tanto, le recomendamos revisar cuidadosamente su decisión antes
                                de proceder con la
                                cancelación. Si en el futuro decide volver a acceder a los cursos y materiales de la
                                plataforma, <strong>tendrá que volver a suscribirse al plan correspondiente y realizar el
                                    pago de la tarifa de suscripción aplicable.</strong></p>
                        </div>
                    </div>


                    <div class="mi-card mb-4">
                        <div class="mi-card-content py-3">
                            <h3 class="card-title">8. Responsabilidad y Garantías</h3>
                            <p class="text-justify">La Plataforma se proporciona "tal cual" y "según disponibilidad". No
                                garantizamos que el
                                servicio será ininterrumpido, libre de errores o seguro. En la medida máxima permitida por
                                la ley, no seremos responsables de ningún daño indirecto, incidental, especial o consecuente
                                que surja del uso o la incapacidad de usar nuestros servicios.</p>
                        </div>
                    </div>

                    <div class="mi-card mb-4">
                        <div class="mi-card-content py-3">
                            <h3 class="card-title">9. Modificaciones a los Términos</h3>
                            <p class="text-justify">Nos reservamos el derecho de modificar estos Términos en cualquier
                                momento. Publicaremos los
                                términos actualizados en la Plataforma y la fecha de la última revisión. El uso continuado
                                de la Plataforma después de la publicación de los términos modificados constituirá su
                                aceptación de dichos términos.</p>
                        </div>
                    </div>

                    <div class="mi-card mb-4">
                        <div class="mi-card-content py-3">
                            <h3 class="card-title">10. Contacto</h3>
                            <p class="text-justify">Si tiene alguna pregunta o inquietud acerca de estos Términos, por
                                favor contáctenos a
                                <strong>[preunicursos@gmail.com]</strong>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
