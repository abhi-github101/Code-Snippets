#include<stdio.h>
#include<stdlib.h>

struct node{
    int key;
	struct node *next;
};

struct node *create();
void insertInFront(int key);
void insertAtEnd(int key);
void insertAfterKey(int data,int key);//if key not present, add key in front
void deleteKey(int key);
int searchKey(int key);
void printNodes();

struct node *head=NULL;

int main(){
   
    while(true){
        int o=0;
        printf("\nSelect One Option:\n1. Search Key\n2. Insert In Front\n3. Insert At End\n4. Insert After Key\n5. Delete Key\n6. Print\nEnter Your Choice: ");
        scanf("%d",&o);
        switch(o){
            case 1://search
                {
                printf("\nSEARCH KEY: ");
                int key;
                scanf("%d",&key);
                searchKey(key);
                }                
                break;
            case 2://insert in front
                {
                printf("\nINSERT IN FRONT: ");
                int key;
                scanf("%d",&key);
                insertInFront(key);                
                }    
                break;
            case 3://insert at end
                {
                printf("\nINSERT AT END: ");
                int key;
                scanf("%d",&key);
                insertAtEnd(key);                
                }
                break;
            case 4://insert after key
                {
                printf("\nINSERT AFTER KEY(<data> <key>): ");
                int key,data;
                scanf("%d %d",&data,&key);
                insertAfterKey(data,key);                
                }
                break;
            case 5://delete key
                {
                printf("\nDELETE KEY: ");
                int key;
                scanf("%d",&key);
                deleteKey(key);                
                }
                break;
			case 6://print
				printNodes();
				break;
            default: printf("\n*********** Bye *************\n");
                exit(0);
                break;
                
        }          
}
		
return 0;	
}

struct node *create(){
    return (struct node *)malloc(sizeof(struct node));
}

void insertInFront(int key){
    printf("Before: ");        
    printNodes();
    struct node *n;
    n=create();
    n->key=key;
    n->next=head;
	head=n;
        
    printf("After: ");
    printNodes();
}

void insertAtEnd(int key){
    printf("Before: ");        
    printNodes();
    struct node *n,*temp=head,*prev;
    n=create();
    n->key=key;
    n->next=NULL;
	
	while(temp){
		prev=temp;
		temp=temp->next;
	}
	prev->next=n;
        
    printf("After: ");
    printNodes();
}

void insertAfterKey(int data,int key){
    struct node *n,*temp=head;
    n=create();
    n->key=key;
    if(searchKey(data)){
		while(temp){
			if(temp->key==data){
				break;
			}
			temp=temp->next;
		}
		n->next=temp->next;
		temp->next=n;
		printNodes();
	}else{
		insertInFront(key);
	}
	
}

void deleteKey(int key){
    struct node *temp=head,*prev;
	if(searchKey(key)){
	while(temp){
		if(temp->key==key){
			break;
		}
		prev=temp;
		temp=temp->next;
	}
		if(temp==head){
			head=temp->next;
		}else{
		prev->next=temp->next;
		}
		free(temp);
		printNodes();
	}
}

int searchKey(int key){
    struct node *temp;
	temp=head;
    while(temp){
        if(temp->key==key){
            printf("\nNode Found\n");
            printNodes();
			return 1;
        }
        temp=temp->next;
    }
    printf("\nNode Not Present\n");
    printNodes();
	return 0;
}

void printNodes(){
    struct node *temp;
	temp=head;
        while(temp){
            printf("%d ",temp->key);
            temp=temp->next;			
        }
		printf("\n");        
}
