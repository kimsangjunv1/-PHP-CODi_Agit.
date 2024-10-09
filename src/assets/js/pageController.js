export class pageController {
    constructor() {
        editor: {}
    }

    static layout = {
        showSearchContainer: () => {
            const elementSearchControlBtn = document.querySelectorAll("button.btn-search-control");
            const elementSearchContainer = document.querySelector("#search");
            
            elementSearchControlBtn.forEach((e, i) => {
                e.addEventListener("click", (event) => {
                    let state = event.target.value;
    
                    state == 1 ? elementSearchContainer.classList.remove("none") : elementSearchContainer.classList.add("none");
                })
            })
        },

        setCurrentProgressBar: () => {
            const progressContainerElement = document.querySelector("#progress");
            
            if (progressContainerElement) {
                const progressBarElement = progressContainerElement.querySelector(".bar");
                
                window.addEventListener("scroll", () => {
                    progressBarElement.style.width = this.common.checkCurrentScroll() + "%";
                });
            }
        },
    }

    static home = {
        specific: () => {
            const buttons = document.querySelectorAll("#tab button");
            const element = document.querySelectorAll("#home article");

            let idName = "js";

            const removeClassNameNone = () => {
                element.forEach((e, i) => {
                    if (e.id !== "showcase" && e.id !== "all" && e.id !== "tab") {
                        e.classList.add("none")
                    };

                    if (idName === '') {
                        idName = "programmers";
                    };

                    if (e.id === idName) {
                        e.classList.remove("none");
                    };
                });
            }

            if (buttons) {
                buttons.forEach((e, i) => {
                    // 각 버튼에 클릭 이벤트 추가
                    e.addEventListener("click", (event) => {
                        buttons.forEach(button => button.classList.remove("active"));
                        event.target.classList.add("active");
                        idName = event.target.value;
                
                        removeClassNameNone();
                    });
                });
            };

            removeClassNameNone();
        },

        showcase: () => {
            const container = document.querySelector("#showcase");
            const elementItem = container.querySelectorAll(".item");
            const SLIDE_INTERVAL = 5000; // 10초

            let rotate_que = Math.floor(Math.random()*101);
            let size_que = Math.floor(Math.random()*5)+1;
            let currentIndex = 1;

            // 함수: 슬라이더 상태 업데이트
            const updateSlider = () => {
                currentIndex++;

                if (currentIndex > elementItem.length) {
                    currentIndex = 1;
                    elementItem.forEach(thumb => thumb.classList.remove("none"));
                }

                // 모든 썸네일 비활성화
                elementItem.forEach(thumb => thumb.classList.remove("view"));

                // 이전 항목 숨기기
                if (currentIndex > 1) {
                    elementItem[currentIndex - 2].classList.add("none");
                }

                // 현재 항목 활성화
                elementItem[currentIndex - 1].classList.add("view");

                // 다음 슬라이더 업데이트 10초 후에 실행
                setTimeout(updateSlider, SLIDE_INTERVAL);
            };

            // 함수: 이미지 이동 및 회전, 크기 조정 함수
            const updateFigureTransform = (centerX, centerY, rotate_que, size_que) => {
                //이미지 움직이기
                for(let i=1; i<=elementItem.length; i++){
                    for(let q=1; q<=4; q++){
                        let isElementVisible = document.querySelector(".item:nth-child("+i+") .thumbnail figure:nth-child("+q+")");

                        let randValue = (q*size_que)*0.05;
                        let limitMinValue = 0.25;

                        let size = randValue <= limitMinValue || randValue >= 1  ? limitMinValue : randValue;

                        if(isElementVisible){
                            isElementVisible.style.transform = "translate("+ (-centerX)/(q*4) +"px, "+ (-centerY)/(q*5)+"px) rotate("+ rotate_que*(q*5) +"deg) scale("+size+")";
                        }
                    }
                }
            };

            // 첫 로드시 view 추가
            elementItem[0].classList.add("view");

            // 첫 로드시 기본 세팅
            updateFigureTransform(1184, 379, rotate_que, size_que);

            // 처음 슬라이더 업데이트 시작 (10초 후에 실행)
            setTimeout(updateSlider, SLIDE_INTERVAL);

            // 마우스 움직임 이벤트 리스너는 한 번만 등록
            container.addEventListener("mousemove", (e) => {
                const mouseX = e.pageX;
                const mouseY = e.pageY;
                const centerX = window.innerWidth / 2 - mouseX;
                const centerY = window.innerHeight / 2 - mouseY;

                // 썸네일의 움직임과 크기 조절
                elementItem.forEach((e) => {
                    if (e.classList.contains("view")) {
                        const elementThumbnail = e.querySelectorAll(".thumbnail figure");
    
                        elementThumbnail.forEach( e => updateFigureTransform(centerX, centerY, rotate_que, size_que) );
                    }
                });
            });
        }
    }

    static category = {
        main: () => {
            
        },

        writeNew: () => {
            const editor = SUNEDITOR.create('postContents', {
                lang: SUNEDITOR_LANG['ko'],
                width: "100%",
                height: 512,
                buttonList: [['font', 'fontSize', 'formatBlock', 'bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'indent', 'outdent', 'align', 'list', 'table', 'link', 'image', 'video', 'audio', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'imageGallery']]
            });

            const elementForm = document.querySelector("#form");

            elementForm.addEventListener('submit', function() {
                const contents = editor.getContents();
                document.getElementById('postContents').value = contents;
            });
        },

        modifyNew: (value) => {
            // const test = document.getElementById("postContents").innerHTML;
            const editor = SUNEDITOR.create('postContents', {
                lang: SUNEDITOR_LANG['ko'],
                width: "100%",
                height: 400,
                buttonList: [['font', 'fontSize', 'formatBlock', 'bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'fontColor', 'hiliteColor', 'indent', 'outdent', 'align', 'list', 'table', 'link', 'image', 'video', 'audio', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'imageGallery']]
            });

            const elementForm = document.querySelector("#form");

            elementForm.addEventListener('submit', function() {
                const contents = editor.getContents();
                document.getElementById('postContents').value = contents;
            });
        },

        remove: () => {

        },

        view: () => {
            const elementPre = document.querySelectorAll("pre");
            const elementHeader = document.querySelector("header");
        
            elementPre.forEach((e, i) => {
                const elementCode = e.querySelector("code");

                if (!elementCode) {
                    let value = e.innerHTML;

                    e.innerHTML = `
                        <code>${value}</code>
                    `
                    e.classList.add("asdasdasd");
                } else {
                    elementCode.classList.add("hljs");
                }
            })

            elementHeader.classList.add("transparent");
        }
    }

    static login() {
        console.log("로그인");
    }

    // 공통
    static common = {
        // 함수 : 스크롤 제어
        setScrollSmoother: () => {
            const lenis = new Lenis({
                smoothness: 0.2,  // 부드러움, 기본값 1
                damping: 0.2,     // 감속, 기본값 0.8
              });
              
              const raf = (time) => {
                lenis.raf(time);
                requestAnimationFrame(raf);
              };
              
              requestAnimationFrame(raf);
        },

        // 함수 : 스크롤시 resize를 붙일 요소
        setResizeElementOnScroll: () => {
            const elementShowcase = document.querySelector("#showcase");
            const elementHeader = document.querySelector("#header");
            const elementViewThumbnail = document.querySelector("#category.view .header");
            
            let limitValue = 1;

            const setResize = (target, scrollValue) => {
                scrollValue > limitValue ? target.classList.add("resize") : target.classList.remove("resize");
            };

            window.addEventListener("scroll", () => {
                let scrollValue = this.common.checkCurrentScroll();

                elementViewThumbnail && setResize(elementViewThumbnail, scrollValue);
                elementShowcase && setResize(elementShowcase, scrollValue);
                elementHeader && setResize(elementHeader, scrollValue);

            })
        },

        // 함수 : 탭 선택시 해당 탭에 선택된곳에 none을 지움
        setClassName: () => {
            
        },

        // 함수 : 현재 스크롤 값 반환
        checkCurrentScroll: () => {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    
            return (winScroll / height) * 100;
        },

        // 함수 : 폼데이터 전달
        sendFormContents: () => {
            document.querySelector("#form").addEventListener("submit", (event) => {
                const content = this.editor.getMarkdown(); // Get markdown or use getHtml() for HTML content

                document.querySelector("#postContents").value = content.replace(/<br\s*\/?>/gi, '\n'); // Sync content to textarea
                event.target.submit(); // 이제 폼을 제출합니다.
            })
        },

        // 함수 : 이미지 저장 후 URL로 반환
        // 이미지 업로드 후 제출시 이 함수를 작동시켜 url로 반환 받은걸 저장할때 썸네일로 활용
        saveImgToUrl: async(blob) => {
            const formData = new FormData();
            formData.append("imgFile", blob); // 서버에서 받을 이름과 맞춤

            console.log("blob : ", blob);
            console.log("formdata : ", formData);

            try {
                const response = await fetch("/src/components/common/component_upload.php", {
                    method: "POST",
                    body: formData
                });
                const result = await response.json();

                if (result.success) {
                    // 업로드 성공 시 이미지 URL을 에디터에 삽입
                    return result.imageUrl;
                } else {
                    alert(result.message);
                }
            } catch (error) {
                console.error("Error uploading image:", error);
            }
        },

        // 아직 미사용 함수
        addImageBlobHook: async (blob, callback) => {
            const formData = new FormData();
            formData.append("imgFile", blob); // 서버에서 받을 이름과 맞춤

            try {
                const response = await fetch("/src/components/common/component_upload.php", {
                    method: "POST",
                    body: formData
                });
                const result = await response.json();

                if (result.success) {
                    // 업로드 성공 시 이미지 URL을 에디터에 삽입
                    callback(result.imageUrl, "Image");
                } else {
                    alert(result.message);
                }
            } catch (error) {
                console.error("Error uploading image:", error);
            }
        }
    }
}